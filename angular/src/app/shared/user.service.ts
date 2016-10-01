import { Injectable } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { User } from './index';
import 'rxjs/add/operator/toPromise';
import { Observable } from 'rxjs';
import { Cookie } from 'ng2-cookies/ng2-cookies';

@Injectable()
export class UserService {
    private models: User[] = [];
    private endpointUrl = 'http://homestead.com/api/account';
    private headers = new Headers({ 'Content-Type': 'application/json' });
    private token: string;

    public constructor(private http: Http) {
        this.token = Cookie.get('token');
        if (this.token) {
            this.headers.append('Authorization', `Bearer ${this.token}`);
        }
    }

    public all(): Promise<User[]> {
        return Promise.resolve(this.models);
    }

    public one(id: number): Promise<User> {
        return this.all().then(models => models.find((user) => user.account.id === id));
    }

    public cache(model: User) {
        let index = this.models.findIndex((user) => user.account.id === model.account.id);
        if (index === -1) {
            this.models.push(model);
        } else {
            this.models[index] = model;
        }
    }

    public authenticated(): User {
        if (!this.models.length) {
            this.authenticate().subscribe((user) => {
                return user;
            });
        } else {
            return this.models[0];
        }
    }

    private authenticate(): Observable<User> {
        return this.http
            .get(this.endpointUrl, { headers: this.headers })
            .map((response) => response.json())
            .catch(this.handleError);
    }

    private handleError(error: any) {
        return Observable.throw(error.json());
    }
}
