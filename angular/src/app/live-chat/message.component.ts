import { Component, Input, OnInit } from '@angular/core';
import { Message } from './index';
import { User } from '../shared/index';
import { UserService } from '../shared/user.service';

@Component({
    selector: 'app-live-chat-message',
    templateUrl: './message.component.html',
})
export class MessageComponent implements OnInit {
    @Input() public message: Message;
    public author: User;

    public constructor(private userService: UserService) {
    }

    public ngOnInit() {
        if (this.message && this.message.author_id) {
            this.userService.one(this.message.author_id)
                .then(user => this.author = user)
                .catch(error => console.log(error));
        }
    }

}
