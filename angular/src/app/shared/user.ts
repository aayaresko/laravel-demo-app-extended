import { Account, AccountProfile } from '../account/index';

export class User {
    public account: Account;
    public profile: AccountProfile;
    private uploads_path: string;

    public constructor(private data: any) {
        if (data.hasOwnProperty('account')) {
            this.account = new Account(data.account.id, data.account.name, data.account.email, data.account.status, data.account.created_at);
            if (data.account.hasOwnProperty('profile')) {
                let profile = data.account.profile;
                this.profile = new AccountProfile(profile.first_name, profile.last_name, profile.birth_date, profile.avatar_url, this.account.id);
            }
        }
        if (data.hasOwnProperty('options')) {
            this.uploads_path = data.options.uploads_path ? data.options.uploads_path : null;
        }
        this.data = null;
    }

    public getFullName() {
        if (this.account) {
            if (this.profile) {
                let full_name = `${this.profile.first_name} ${this.profile.last_name}`;
                full_name = full_name.trim();
                if (full_name !== '') {
                    return full_name;
                }
            }
            return this.account.name;
        }
    }

    public getAvatarUrl() {
        if (this.profile) {
            return `/${this.uploads_path}/thumbnail/${this.profile.avatar_url}`;
        }
    }

    public getDetailUrl() {
        return `/en/account/show/${this.account.id}`;
    }
}
