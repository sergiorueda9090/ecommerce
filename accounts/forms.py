from django import forms
from .models import Account

class RegistrationForm(forms.ModelForm):
    
    password = forms.CharField(label='Password', 
                               widget=forms.PasswordInput(attrs={'class':'form-control',
                                                                 'placeholder':'Password'}))
    
    confirm_password = forms.CharField(label='Password',
                                       widget=forms.PasswordInput(attrs={'class':'form-control',
                                                                         'placeholder':'Confirm Password'}))
    class Meta:
        model = Account
        fields = ['first_name', 'last_name', 'phone_number', 'email', 'password']
        
    def __init__(self, *args, **kwargs):
        super(RegistrationForm, self).__init__(*args, **kwargs)
        self.fields['first_name'].widget.attrs['placeholder'] = 'Enter First Name'
        self.fields['last_name'].widget.attrs['placeholder'] = 'Enter Last Name'
        self.fields['phone_number'].widget.attrs['placeholder'] = 'Enter Phone Number'
        self.fields['email'].widget.attrs['placeholder'] = 'Enter Email Address'
        for field in self.fields:
            self.fields[field].widget.attrs.update({'class':'form-control'})
    
    def clean(self):
        clean_data = super(RegistrationForm, self).clean()
        password = clean_data.get('password')
        confirm_password = clean_data.get('confirm_password')
        
        if password != confirm_password:
            raise forms.ValidationError('Passwords does not match!')
