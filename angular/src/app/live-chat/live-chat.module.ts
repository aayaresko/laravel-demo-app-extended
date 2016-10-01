import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { LiveChatComponent, MessageComponent, MessageFormComponent, MessagesListComponent } from './index';
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
