// SweetAlert2 is only needed for a handful of interactions (emergency call
// confirmation, auth form feedback, flash messages) — importing it eagerly
// would ship ~30KB+ of JS to every visitor who never triggers any of those.
// This dynamic import lets Vite split it into its own chunk, fetched once on
// first use and cached (module-level promise) for the rest of the session.
let swalPromise;

export function loadSwal() {
    if (!swalPromise) {
        swalPromise = import('sweetalert2').then((mod) => mod.default);
    }
    return swalPromise;
}
