import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LiveChatComponent } from './live-chat/live-chat.component';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
import { UserResolveService } from './shared/user-resolve.service';

const appRoutes: Routes = [
    {
        path: ':locale/live-chat/index',
        component: LiveChatComponent,
        resolve: {
            user: UserResolveService
        },
    },
    { path: '**', component: PageNotFoundComponent }
];

export const appRoutingProviders: any[] = [];

export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);
