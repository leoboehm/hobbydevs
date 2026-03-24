export const rules = {
    required: v => !!v || 'Please enter a value.',
    email: v => /.+@.+\..+/.test(v) || 'Please enter a valid email address.',
    minLength: min => value => value.length >= min || `Must be at least ${min} characters.`,
    matchPassword: value => value === password.value || 'Passwords are not identical.',
}