import { Component, OnInit } from '@angular/core';
import { User } from '../shared/user';
import { UserService } from '../shared/user.service';
import { TaskService } from './task.service';

@Component({
    selector: 'app-tasks-board',
    templateUrl: './tasks-board.component.html'
})
export class TasksBoardComponent implements OnInit {
    private user: User = null;

    public constructor(private userService: UserService, private taskService: TaskService) {
    }

    public ngOnInit() {
        this.user = this.userService.authenticated();
    }

    public onPersistTask(task: any) {
        this.taskService.store(task);
    }

}
