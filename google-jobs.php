<?php
    function createGoogleJobJSON($vacancyId) {
        // get post by id
        if ($vacancyId === null) {
            return;
        }
        $vacancy = get_post($vacancyId);

        $googleJob = new stdClass();
        $googleJob->{'@context'} = 'http://schema.org';
        $googleJob->{'@type'} = 'JobPosting';

        $googleJob->title = $vacancy->post_title;

        if (get_field('vacancy_description', $vacancyId);) {
            $googleJob->description = get_field('vacancy_description', $vacancyId);
        }

        $googleJob->datePosted = $vacancy->post_date;

        $googleJob->validThrough = date('Y-m-d', strtotime($vacancy->post_date . ' + 10 year'));

        if (get_field('vacancy_type', $vacancyId);) {
            $googleJob->employmentType = get_field('vacancy_type', $vacancyId);
        }
        
        $googleJob->hiringOrganization = new stdClass();
        $googleJob->hiringOrganization->{'@type'} = 'Organization';
        $googleJob->hiringOrganization->name = get_field('options_contact_company', 'option');
        $googleJob->hiringOrganization->sameAs = get_home_url();
        $googleJob->hiringOrganization->logo = get_field('options_favicon', 'option');

        $googleJob->jobLocation = new stdClass();
        $googleJob->jobLocation->address = new stdClass();
        $googleJob->jobLocation->{'@type'} = 'streetAddress';
        $googleJob->jobLocation->address->streetAddress = get_field('options_contact_street', 'option');
        $googleJob->jobLocation->{'@type'} = 'addressLocality';
        $googleJob->jobLocation->address->addressLocality = get_field('options_contact_city', 'option');
        $googleJob->jobLocation->{'@type'} = 'postalCode';
        $googleJob->jobLocation->address->postalCode = get_field('options_contact_postal_code', 'option');
        $googleJob->jobLocation->{'@type'} = 'addressCountry';
        $googleJob->jobLocation->address->addressCountry = 'Nederland';

        if (get_field('vacancy_salary_hour', $vacancyId);) {
            $googleJob->baseSalary = new stdClass();
            $googleJob->baseSalary->{'@type'} = 'MonetaryAmount';
            $googleJob->baseSalary->currency = 'EUR';
            $googleJob->baseSalary->value = new stdClass();
            $googleJob->baseSalary->value->{'@type'} = 'QuantitativeValue';
            $googleJob->baseSalary->value->value = get_field('vacancy_salary_hour', $vacancyId);
            $googleJob->baseSalary->value->unitText = 'HOUR';
        }

        $googleJob->identifier = $vacancyId;

        $googleJob->url = get_permalink($vacancyId);

        // echo '<pre>' . json_encode($googleJob) . '</pre>';
        return json_encode($googleJob);
    }

    // get taxonomy terms by name and post id
    function get_taxonomy_terms_by_name($post_id, $taxonomy_name) {
        $terms = get_the_terms($post_id, $taxonomy_name);
        $terms_names = array();
        if ($terms) {
            foreach ($terms as $term) {
                $terms_names[] = isset($term->name) ? $term->name : '';
            }
        }

        return $terms_names[0];
    }
?>