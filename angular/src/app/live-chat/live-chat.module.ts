import { NgModule } from '@angular/core';
import { SharedModule } from '../shared/shared.module';
import { LiveChatComponent } from './live-chat.component';
import { MessageDetailComponent } from './message-detail/message-detail.component';
import { MessageFormComponent } from './shared/message-form.component';
import { MessagesListComponent } from './message-list/messages-list.component';
import { WindowResizeDirective } from '../window-resize.directive';

@NgModule({
    imports: [
        SharedModule
    ],
    declarations: [
        LiveChatComponent,
        MessageDetailComponent,
        MessageFormComponent,
        MessagesListComponent,
        WindowResizeDirective,
    ]
})
export class LiveChatModule {
}
