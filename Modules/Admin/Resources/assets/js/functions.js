import { ohSnap } from './ohsnap';

export function trans(langKey, replace = {}) {
    let line = window.FleetCart.langs[langKey];

    for (let key in replace) {
        line = line.replace(`:${key}`, replace[key]);
    }

    return line;
}

export function keypressAction(actions) {
    $(document).keypressAction({ actions });
}

export function notify(type, message, { duration = 5000, context = document }) {
    let types = {
        'info': 'blue',
        'success': 'green',
        'warning': 'yellow',
        'error': 'red',
    };

    ohSnap(message, {
        'container-id': 'notification-toast',
        context,
        color: types[type],
        duration,
    });
}

export function info(message, duration) {
    notify('info', message, { duration });
}

export function success(message, duration) {
    notify('success', message, { duration });
}

export function warning(message, duration) {
    notify('warning', message, { duration });
}

export function error(message, duration) {
    notify('error', message, { duration });
}

/**
 * @see https://stackoverflow.com/a/3955096
 */
if (! Array.prototype.remove) {
    Array.prototype.remove = function () {
        let what, a = arguments, L = a.length, ax;

        while (L && this.length) {
            what = a[--L];

            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }

        return this;
    };
}

/**
 * @see https://stackoverflow.com/a/4673436
 */
if (! String.prototype.format) {
    String.prototype.format = function () {
        return this.replace(/%(\d+)%/g, (match, number) => {
            return typeof arguments[number] !== 'undefined' ? arguments[number] : match;
        });
    };
}
