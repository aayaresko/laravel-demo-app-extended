import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { LiveChatComponent } from './live-chat/live-chat.component'
import { UserResolveService } from './core/user-resolve.service'
import { PageNotFoundComponent } from './page-not-found/page-not-found.component'

@NgModule({
    imports: [
        RouterModule.forRoot([
            {
                path: '',
                resolve: {
                    user: UserResolveService,
                },
                children: [
                    {
                        path: ':locale/live-chat/index',
                        component: LiveChatComponent,
                    },
                ]
            },
            { path: '**', component: PageNotFoundComponent }
        ])
    ],
    exports: [
        RouterModule
    ],
    declarations: []
})
export class AppRoutingModule {

}
