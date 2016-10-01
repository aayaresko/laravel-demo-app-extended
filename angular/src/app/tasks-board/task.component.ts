import { Component, OnInit, Input } from '@angular/core';
import { Task } from './index';
import { User } from '../shared/user';
import { UserService } from '../shared/user.service';

@Component({
    selector: 'app-tasks-board-task',
    templateUrl: './task.component.html'
})
export class TaskComponent implements OnInit {
    @Input() public task: Task;
    public author: User;

    public constructor(private userService: UserService) {
    }

    public ngOnInit() {
        if (this.task && this.task.author_id) {
            this.userService.one(this.task.author_id)
                .then(user => this.author = user)
                .catch(error => console.log(error));
        }
    }
}
