const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const requiredFields = ['Skills', 'Contact Information'];

export function submitApplication(data) {
  for (const field of requiredFields) {
    if (!data[field]) {
      return {
        success: false,
        message: `${field} is required.`
      };
    }
  }

  if (!emailPattern.test(data['Contact Information'])) {
    return {
      success: false,
      message: 'Invalid email address.'
    };
  }

  return {
    success: true,
    message: 'Application submitted successfully.'
  };
}
