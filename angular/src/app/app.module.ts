import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { Cookie } from 'ng2-cookies/ng2-cookies';
import { AppComponent } from './app.component';
import { PageNotFoundComponent } from './page-not-found/index';
import { LiveChatModule } from './live-chat/live-chat.module';
import { TasksBoardModule } from './tasks-board/tasks-board.module';
import { UserService } from './shared/user.service';
import { routing, appRoutingProviders } from './app.routing';

@NgModule({
    imports: [
        BrowserModule,
        FormsModule,
        ReactiveFormsModule,
        HttpModule,
        routing,
        LiveChatModule,
        TasksBoardModule
    ],
    declarations: [
        AppComponent,
        PageNotFoundComponent,
    ],
    providers: [UserService, Cookie, appRoutingProviders],
    bootstrap: [AppComponent]
})
export class AppModule {
}
