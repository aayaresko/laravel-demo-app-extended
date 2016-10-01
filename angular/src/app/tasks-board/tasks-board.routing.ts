import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { TasksBoardComponent } from './tasks-board.component';

const tasksRoutes: Routes = [
    {
        path: ':locale/tasks-board',
        children: [
            { path: 'index', component: TasksBoardComponent },
            // { path: 'show/:id', component: TasksBoardComponent },
            // { path: 'edit/:id', component: TasksBoardComponent },
            // { path: 'delete/:id', component: TasksBoardComponent },
        ]
    }
];

export const tasksRouting: ModuleWithProviders = RouterModule.forChild(tasksRoutes);
