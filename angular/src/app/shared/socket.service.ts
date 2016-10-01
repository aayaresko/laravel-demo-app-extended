import { Injectable, EventEmitter, OnDestroy } from '@angular/core';
import { Observable } from 'rxjs/Observable';
import { Cookie } from 'ng2-cookies/ng2-cookies';
import 'rxjs/add/operator/toPromise';
import * as io from 'socket.io-client';

@Injectable()
export class SocketService implements OnDestroy {
    private host: string = `${window.location.protocol}//${window.location.hostname}:8081`;
    private socket;
    public status = new EventEmitter();

    public constructor() {
    }

    public configure(): void {
        let token = Cookie.get('token');
        if (token) {
            token = `token=${token}`;
        }
        this.socket = io(this.host, {
            'query': token
        });
    }

    public asObservable(): Observable<any> {
        return Observable.create(
            (observer) => {
                this.socket.on('connect', () => {
                    let status = 'connected';
                    this.status.emit(status);
                    observer.next({ action: status });
                });
                this.socket.on('disconnect', () => {
                    let status = 'disconnected';
                    this.status.emit(status);
                    observer.next({ action: status });
                });
                this.socket.on('user account', (data) => observer.next({ action: 'user-account', data: data }));
                this.socket.on('chat message', (data) => observer.next({ action: 'chat-message', data: data }));
                this.socket.on('notify others', (data) => observer.next({ action: 'system-message', data: data }));
                return () => this.socket.close();
            }
        );
    }

    public send(data: any) {
        this.socket.emit('chat message', data);
    }

    public latest(index: number) {
        this.socket.emit('latest messages', { index: index });
    }

    public subscribeToSocketEvent(name, callback) {
        this.socket.on(name, callback);
    }

    public ngOnDestroy() {
        this.socket.close();
    }
}