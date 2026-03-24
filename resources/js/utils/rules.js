export const rules = {
    required: v => !!v || 'Please enter a value.',
    email: v => /.+@.+\..+/.test(v) || 'Please enter a valid email address.',
    minLength: min => v => v.length >= min || `Must be at least ${min} characters.`,
    matchPassword: (getTarget) => {
        return (value) =>
            value === getTarget() || 'Passwords are not identical.'
    },
}