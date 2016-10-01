import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TaskComponent, TasksListComponent, TasksBoardComponent } from './index';
import { tasksRouting } from './index';
import { TaskService } from './index';

@NgModule({
    imports: [
        CommonModule,
        tasksRouting
    ],
    declarations: [
        TasksBoardComponent,
        TasksListComponent,
        TaskComponent
    ],
    providers: [
        TaskService
    ]
})
export class TasksBoardModule {
}
