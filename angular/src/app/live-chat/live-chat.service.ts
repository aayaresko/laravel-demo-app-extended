import { Injectable, EventEmitter } from '@angular/core';
import { Message } from './index';
import { MessageService } from './message.service';
import { User } from '../shared/index';
import { UserService } from '../shared/user.service';
import { SocketService } from '../shared/socket.service';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class LiveChatService {
    public authenticatedUser = new EventEmitter();
    public connectionStatus = this.socketService.status;

    public constructor(private socketService: SocketService, private messageService: MessageService, private userService: UserService) {
        this.socketService.configure();
        this.socketService.asObservable().subscribe(
            (item) => this.process(item),
            (error) => console.log(error)
        );
    }

    public persist(message: Message) {
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
                this.userService.authenticated().then((user) => this.authenticatedUser.emit(user));
                break;
        }
    }
}
