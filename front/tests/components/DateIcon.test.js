import { describe, it, expect } from 'vitest';
import { mount } from '@vue/test-utils';
import DateIcon from '../../components/ui/DateIcon.vue';

describe('DateIcon', () => {
  it('renders the correct date and month from the dateTime prop', () => {
    const wrapper = mount(DateIcon, {
      props: {
        dateTime: '2023-06-23' // Une date de test
      }
    });
    const dateNumber = wrapper.find('.date-number');
    const dateMonth = wrapper.find('.date-month');

    expect(dateNumber.text()).toBe('23'); // S'attend à ce que le jour soit 23
    expect(dateMonth.text()).toBe('JUIN'); // S'attend à ce que le mois soit en majuscules
  });
});
// test si le composant DateIcon affiche correctement le jour et le mois à partir de la prop dateTime.