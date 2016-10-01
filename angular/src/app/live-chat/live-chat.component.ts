import { Component, OnInit, trigger, style, transition, animate } from '@angular/core';
import { User } from '../shared/index';
import { SocketService } from '../shared/socket.service';
import { LiveChatService } from './live-chat.service';
import { MessageService } from './message.service';

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
    providers: [SocketService, MessageService, LiveChatService]
})
export class LiveChatComponent implements OnInit {
    private user: User = null;
    private connectionStatus = 'disconnected';

    public constructor(private chatService: LiveChatService) {
    }

    public ngOnInit() {
        this.chatService.authenticatedUser.subscribe((user) => {
            this.user = user;
        });
        this.chatService.connectionStatus.subscribe((status) => {
            this.connectionStatus = status;
        });
    }

    public onPersistMessage(message: any) {
        this.chatService.persist(message);
    }
}
