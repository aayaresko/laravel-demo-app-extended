import { Component, OnInit, trigger, style, transition, animate, OnDestroy } from '@angular/core';
import { User } from '../shared/index';
import { Message } from './index';
import { SocketService } from '../shared/socket.service';
import { MessageService } from './message.service';
import { UserService } from '../shared/user.service';

@Component({
    selector: 'app-live-chat',
    templateUrl: './live-chat.component.html',
    animations: [
        trigger('form', [
            transition('void => *', [
                style({ opacity: 0 }),
                animate('300ms, 600ms easeInOutBack', style({ opacity: 1 })),
            ]),
            transition('* => void', style({ opacity: 0 }))
        ]),
        trigger('notification', [
            transition('void => *', [
                style({ opacity: 0 }),
                animate('300ms, 600ms easeInOutBack', style({ opacity: 1 })),
            ]),
            transition('* => void', style({ opacity: 0 }))
        ])
    ],
    providers: [
        SocketService,
        MessageService,
        UserService
    ]
})
export class LiveChatComponent implements OnInit, OnDestroy {
    private user: User = null;
    public connectionStatus = 'disconnected';

    public constructor(private socketService: SocketService, private messageService: MessageService, private userService: UserService) {
    }

    public ngOnInit() {
        this.socketService.configure();
        this.socketService.asObservable().subscribe(
            (item) => this.process(item),
            (error) => console.log(error)
        );
        this.socketService.status.subscribe((status) => {
            this.connectionStatus = status;
        });
    }

    public ngOnDestroy() {
        this.socketService.status.unsubscribe();
    }

    public onPersistMessage(message: any) {
        this.socketService.send({ message: message });
    }

    private process(item) {
        let action = item.action;
        switch (action) {
            case 'connected':
                this.socketService.latest(this.messageService.getIndex());
                break;
            case 'chat-message':
            case 'system-message':
                let data = item.data.message;
                let message = new Message(data.content, data.author_id, data.created_at, action, data.id);
                this.messageService.cache(message);
                this.userService.cache(new User(item.data));
                break;
            case 'user-account':
                this.userService.cache(new User(item.data));
                this.user = this.userService.authenticated();
                break;
        }
    }
}
