import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { LiveChatComponent } from './live-chat.component';
import { MessageComponent } from './message.component';
import { MessageFormComponent } from './message-form.component';
import { MessagesListComponent } from './messages-list.component';
import { WindowResizeDirective } from '../window-resize.directive';

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        ReactiveFormsModule,
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
