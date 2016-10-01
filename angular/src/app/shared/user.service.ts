import { Injectable } from '@angular/core';
import { User } from './index';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class UserService {
    private models: User[] = [];

    public constructor() {
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

    public authenticated() {
        return this.all().then((users) => users[0]);
    }
}
