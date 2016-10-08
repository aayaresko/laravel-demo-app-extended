import { NgModule } from '@angular/core';
import { SharedModule } from '../shared/shared.module';
import { LiveChatComponent } from './live-chat.component';
import { MessageComponent } from './message.component';
import { MessageFormComponent } from './message-form.component';
import { MessagesListComponent } from './messages-list.component';
import { WindowResizeDirective } from '../window-resize.directive';

@NgModule({
    imports: [
        SharedModule
    ],
    declarations: [
        LiveChatComponent,
        MessageComponent,
        MessageFormComponent,
        MessagesListComponent,
        WindowResizeDirective,
    ]
})
export class LiveChatModule {
}
