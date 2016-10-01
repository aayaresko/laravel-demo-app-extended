import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { TasksBoardComponent } from './tasks-board.component';
import { TaskComponent } from './task.component';

const tasksRoutes: Routes = [
    {
        path: ':locale/tasks-board',
        children: [
            { path: 'index', component: TasksBoardComponent },
            // { path: 'show/:id', component: TaskComponent },
            // { path: 'edit/:id', component: TasksBoardComponent },
            // { path: 'delete/:id', component: TasksBoardComponent },
        ]
    }
];

export const tasksRouting: ModuleWithProviders = RouterModule.forChild(tasksRoutes);
