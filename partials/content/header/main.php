<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$logo_tag         = ( apply_filters( 'eqd_h1_site_title', false ) || ( is_front_page() && is_home() ) ) ? 'h1' : 'p';
$header_main_link = get_field( 'header_main_link', 'option' );
// Assuming you have the post ID
$cat_id = get_the_ID();

// Get the post categories
$categories_id = get_the_category($post_id);

// Check if categories exist for the post
if (!empty($categories_id)) {
	// Retrieve the name of the first category
	$category_id = $categories_id[0]->term_id;
	$link_data = get_field( 'header_button_override',  'category_' . $category_id );
}
?>

<div id="main-navigation">
	<button type="button" id="nav-icon" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
		<span></span>
		<span></span>
		<span></span>
		<span></span>
	</button>

	<div class="left-side">
		<div class="main-logo">
			<?php has_custom_logo() ? the_custom_logo() : '<a href="' . esc_url( home_url() ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>'; ?>
		</div>
		<nav class="primary-navigation" id="primary-navigation" aria-label="Primary Navigation">
			<ul>

			
					<li class="main-nav-link-li 
					has-submenus submenu-column__three column 3 titles 3 columns					">
					
													<button aria-label="Student Loans" type="button" class="menu-item-main-link 
															" data-toggle="Student Loans" aria-expanded="false">
								Student Loans								<span class="chevron">
									<img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/arrow-up-green.svg" alt="chevron arrow">
								</span>
							</button>
							
												
													<div class="sub_menu" id="Student Loans-submenu">
								<button class="sub_menu_back" aria-label="Back to Menu" aria-expanded="false">
									<span class="sub_menu_back__icon"></span>
									<span class="sub_menu_back__text">Back to All</span>
								</button>
								<button type="button" class="nav-icon open" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>

								<div class="sub_menu_dropdown__title">
									Student Loans								</div>
								
															
								<div class="menu-column">
									<h3 class="menu-column_title ">Advice</h3>
									<ul id="menu-advice" class="sub-menu"><li id="menu-item-83324" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/hire-student-loan-help/">Get a Custom Plan</a></li>
<li id="menu-item-83729" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/reviews/">See our 3,000+ Reviews</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Refinancing</h3>
									<ul id="menu-refinancing" class="sub-menu"><li id="menu-item-83731" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/refinance-student-loans/">Get the Best Deal (With Bonuses)</a></li>
<li id="menu-item-83732" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/refinance-student-loans/">Refinancing Strategies</a></li>
<li id="menu-item-83730" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/student-loan-refinance-calculator/">Student Loan Refinance Calculator</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Forgiveness &amp; Repayment</h3>
									<ul id="menu-forgiveness-repayment" class="sub-menu"><li id="menu-item-83734" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/income-driven-repayment/">Income-Driven Repayment</a></li>
<li id="menu-item-83739" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/student-loan-forbearance-and-deferment/">Forbearance &amp; Deferment</a></li>
<li id="menu-item-83738" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/pslf/">PSLF</a></li>
<li id="menu-item-83735" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/parent-plus-loans/">Parent PLUS Loans</a></li>
<li id="menu-item-83736" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/student-loan-forgiveness/">Forgiveness Programs</a></li>
<li id="menu-item-83737" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/student-loan-repayment/">Repayment Strategies</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Paying for School</h3>
									<ul id="menu-paying-for-school" class="sub-menu"><li id="menu-item-83733" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/private-student-loans-without-cosigner/">Private student Loan Options</a></li>
</ul>								</div> 
															</div>
											</li>

					
					<li class="main-nav-link-li 
					has-submenus submenu-column__two column					">
					
													<button aria-label="Mortgages" type="button" class="menu-item-main-link 
															" data-toggle="Mortgages" aria-expanded="false">
								Mortgages								<span class="chevron">
									<img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/arrow-up-green.svg" alt="chevron arrow">
								</span>
							</button>
							
												
													<div class="sub_menu" id="Mortgages-submenu">
								<button class="sub_menu_back" aria-label="Back to Menu" aria-expanded="false">
									<span class="sub_menu_back__icon"></span>
									<span class="sub_menu_back__text">Back to All</span>
								</button>
								<button type="button" class="nav-icon open" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>

								<div class="sub_menu_dropdown__title">
									Mortgages								</div>
								
															
								<div class="menu-column">
									<h3 class="menu-column_title ">Mortgage</h3>
									<ul id="menu-mortgage" class="sub-menu"><li id="menu-item-83874" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/physician-mortgage-loan-options-by-state/">Doctor Mortgage Options by State</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title menu-column-hidden">Mortgage 2</h3>
									<ul id="menu-mortgage-2" class="sub-menu"><li id="menu-item-83933" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/physician-mortgages/">Doctor Mortgage Options by Profession</a></li>
</ul>								</div> 
															</div>
											</li>

					
					<li class="main-nav-link-li 
					has-submenus submenu-column__two column					">
					
													<button aria-label="Practice Loans" type="button" class="menu-item-main-link 
															" data-toggle="Practice Loans" aria-expanded="false">
								Practice Loans								<span class="chevron">
									<img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/arrow-up-green.svg" alt="chevron arrow">
								</span>
							</button>
							
												
													<div class="sub_menu" id="Practice Loans-submenu">
								<button class="sub_menu_back" aria-label="Back to Menu" aria-expanded="false">
									<span class="sub_menu_back__icon"></span>
									<span class="sub_menu_back__text">Back to All</span>
								</button>
								<button type="button" class="nav-icon open" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>

								<div class="sub_menu_dropdown__title">
									Practice Loans								</div>
								
															
								<div class="menu-column">
									<h3 class="menu-column_title ">Practice Loans</h3>
									<ul id="menu-practice-loans" class="sub-menu"><li id="menu-item-83743" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/practice-loans-map-dental-veterinary-medical/">Practice Loan Deals (With Bonuses)</a></li>
<li id="menu-item-83744" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/dental-practice-loan-guide/">Dental Practice Loans</a></li>
<li id="menu-item-83877" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/veterinary-business-loans-guide/">Veterinarian Practice Loans</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title menu-column-hidden">Practice Loans 2</h3>
									<ul id="menu-practice-loans-2" class="sub-menu"><li id="menu-item-83875" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/medical-practice-loans-guide/">Physician Practice Loans</a></li>
</ul>								</div> 
															</div>
											</li>

					
					<li class="main-nav-link-li 
					has-submenus submenu-column__three column 3 titles 3 columns					">
					
													<button aria-label="Insurance" type="button" class="menu-item-main-link 
															" data-toggle="Insurance" aria-expanded="false">
								Insurance								<span class="chevron">
									<img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/arrow-up-green.svg" alt="chevron arrow">
								</span>
							</button>
							
												
													<div class="sub_menu" id="Insurance-submenu">
								<button class="sub_menu_back" aria-label="Back to Menu" aria-expanded="false">
									<span class="sub_menu_back__icon"></span>
									<span class="sub_menu_back__text">Back to All</span>
								</button>
								<button type="button" class="nav-icon open" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>

								<div class="sub_menu_dropdown__title">
									Insurance								</div>
								
															
								<div class="menu-column">
									<h3 class="menu-column_title ">Disability Insurance</h3>
									<ul id="menu-disability-insurance" class="sub-menu"><li id="menu-item-83747" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/quote-form/">Own Occupation Quotes</a></li>
<li id="menu-item-83748" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/long-term-disability-insurance/#toc_12">Disability Quotes by Profession</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Disability Insurance Reviews</h3>
									<ul id="menu-disability-insurance-reviews" class="sub-menu"><li id="menu-item-83749" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/principal-disability-insurance-review/">Principal Review</a></li>
<li id="menu-item-83750" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/standard-disability-insurance-review/">The Standard Disability Review</a></li>
<li id="menu-item-83751" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/massmutual-disability-insurance-review/">MassMutual Review</a></li>
<li id="menu-item-83753" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/guardian-disability-insurance-reviews/">Guardian Review</a></li>
<li id="menu-item-83752" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/ameritas-disability-insurance-reviews/">Ameritas Review</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Term Life Insurance</h3>
									<ul id="menu-term-life-insurance" class="sub-menu"><li id="menu-item-83754" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/get/lifeinsurance">Term Life Quotes</a></li>
<li id="menu-item-83756" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/life-insurance/">Term Life Options by Profession</a></li>
</ul>								</div> 
															</div>
											</li>

					
					<li class="main-nav-link-li 
					has-submenus submenu-column__three column 3 titles 3 columns					">
					
													<button aria-label="Who We Help" type="button" class="menu-item-main-link 
															" data-toggle="Who We Help" aria-expanded="false">
								Who We Help								<span class="chevron">
									<img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/arrow-up-green.svg" alt="chevron arrow">
								</span>
							</button>
							
												
													<div class="sub_menu" id="Who We Help-submenu">
								<button class="sub_menu_back" aria-label="Back to Menu" aria-expanded="false">
									<span class="sub_menu_back__icon"></span>
									<span class="sub_menu_back__text">Back to All</span>
								</button>
								<button type="button" class="nav-icon open" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>

								<div class="sub_menu_dropdown__title">
									Who We Help								</div>
								
															
								<div class="menu-column">
									<h3 class="menu-column_title ">Medical</h3>
									<ul id="menu-medical" class="sub-menu"><li id="menu-item-83342" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/physicians/">Physicians</a></li>
<li id="menu-item-83343" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/dentists/">Dentists &amp; Dental Specialists</a></li>
<li id="menu-item-83346" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/veterinarians/">Veterinarians</a></li>
<li id="menu-item-83757" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/acupuncturists-naturopaths/">Acupuncturists and Naturopaths</a></li>
<li id="menu-item-83354" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/chiropractors/">Chiropractors</a></li>
<li id="menu-item-83344" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/nurse-practitioners/">Nurse &amp; Nurse Practitioners</a></li>
<li id="menu-item-83355" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/occupational-therapists/">Occupational Therapists</a></li>
<li id="menu-item-83357" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/optometrists/">Optometrists</a></li>
<li id="menu-item-83348" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/pharmacists/">Pharmacists</a></li>
<li id="menu-item-83351" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/physician-assistants/">Physician Assistants/Associates</a></li>
<li id="menu-item-83350" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/psychologists/">Psychologists</a></li>
<li id="menu-item-83758" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/speech-language-pathologists/">Speech Language Pathologists</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Non-Medical</h3>
									<ul id="menu-non-medical" class="sub-menu"><li id="menu-item-83760" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/engineers/">Engineers</a></li>
<li id="menu-item-83761" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/financial-advisors/">Financial Advisors</a></li>
<li id="menu-item-83762" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/lawyers/">Lawyers</a></li>
<li id="menu-item-83759" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/mba/">Corporate Employees/MBAs</a></li>
<li id="menu-item-83763" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/occupation/teachers/">Teachers</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Bachelor’s Degree Holders</h3>
									<ul id="menu-bachelors-degree-holders" class="sub-menu"><li id="menu-item-83764" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/idr-forgiveness-undergrads/">Guide to Undergrad Forgiveness Options</a></li>
<li id="menu-item-83765" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/refinance-student-loans/">Guide to Refinancing as an Undergrad</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Parents &amp; Retirees</h3>
									<ul id="menu-parents-retirees" class="sub-menu"><li id="menu-item-83766" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/parent-plus-loans/">Parent PLUS Borrowers</a></li>
<li id="menu-item-83956" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/category/retirement/">Retired Borrowers</a></li>
</ul>								</div> 
															</div>
											</li>

					
					<li class="main-nav-link-li 
					has-submenus submenu-column__three column 3 titles 3 columns					">
					
													<button aria-label="Calculators" type="button" class="menu-item-main-link 
															" data-toggle="Calculators" aria-expanded="false">
								Calculators								<span class="chevron">
									<img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/arrow-up-green.svg" alt="chevron arrow">
								</span>
							</button>
							
												
													<div class="sub_menu" id="Calculators-submenu">
								<button class="sub_menu_back" aria-label="Back to Menu" aria-expanded="false">
									<span class="sub_menu_back__icon"></span>
									<span class="sub_menu_back__text">Back to All</span>
								</button>
								<button type="button" class="nav-icon open" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>

								<div class="sub_menu_dropdown__title">
									Calculators								</div>
								
															
								<div class="menu-column">
									<h3 class="menu-column_title ">Forgiveness Calculators</h3>
									<ul id="menu-forgiveness-calculators" class="sub-menu"><li id="menu-item-83362" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/public-service-loan-forgiveness-pslf-calculator/">PSLF Calculator</a></li>
<li id="menu-item-83359" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/free-student-loan-calculator/">SAVE Plan Forgiveness vs. Repayment Calculator</a></li>
<li id="menu-item-83364" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/parent-plus-loan-calculator/">Parent PLUS Loan Calculator</a></li>
<li id="menu-item-83361" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/income-based-repayment-calculator/">IDR Payment Calculator</a></li>
<li id="menu-item-83368" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/discretionary-income-definition/">Discretionary Income Calculator</a></li>
<li id="menu-item-83366" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/student-loan-interest-calculator/">Student Loan Interest Calculator</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Repayment Calculators</h3>
									<ul id="menu-repayment-calculators" class="sub-menu"><li id="menu-item-83768" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/student-loan-payoff-calculator/">Student Loan Payoff Calculator</a></li>
<li id="menu-item-83770" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/student-loan-interest-calculator/">Student Loan Interest Calculator</a></li>
<li id="menu-item-83769" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/student-loan-refinance-calculator/">Student Loan Refinancing Calculator</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Tax Calculators</h3>
									<ul id="menu-tax-calculators" class="sub-menu"><li id="menu-item-83771" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/student-loan-interest-deduction-calculator/">Student Loan Interest Deduction Calculator</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Mortgage Calculators</h3>
									<ul id="menu-mortgage-calculators" class="sub-menu"><li id="menu-item-83772" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/physician-mortgage-loan-calculator/">Doctor Mortgage Calculator</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Quizzes</h3>
									<ul id="menu-quizzes" class="sub-menu"><li id="menu-item-82230" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/refi-quiz-2/">What Should You Do With Your Student Loans?</a></li>
</ul>								</div> 
															</div>
											</li>

					
					<li class="main-nav-link-li 
					has-submenus submenu-column__three column 3 titles 3 columns					">
					
													<button aria-label="Grow Wealth" type="button" class="menu-item-main-link 
															" data-toggle="Grow Wealth" aria-expanded="false">
								Grow Wealth								<span class="chevron">
									<img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/arrow-up-green.svg" alt="chevron arrow">
								</span>
							</button>
							
												
													<div class="sub_menu" id="Grow Wealth-submenu">
								<button class="sub_menu_back" aria-label="Back to Menu" aria-expanded="false">
									<span class="sub_menu_back__icon"></span>
									<span class="sub_menu_back__text">Back to All</span>
								</button>
								<button type="button" class="nav-icon open" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>

								<div class="sub_menu_dropdown__title">
									Grow Wealth								</div>
								
															
								<div class="menu-column">
									<h3 class="menu-column_title ">Financial Planning</h3>
									<ul id="menu-financial-planning" class="sub-menu"><li id="menu-item-83778" class="menu-item"><a href="https://slpwealth.com/">Fiduciary, Ongoing Financial Planning</a></li>
<li id="menu-item-83779" class="menu-item"><a href="#">Profession-Specific Financial Planning Guides</a></li>
<li id="menu-item-83780" class="menu-item"><a href="#">How To Hire a Financial Planner</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Investing</h3>
									<ul id="menu-investing" class="sub-menu"><li id="menu-item-83781" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/pay-student-loans-or-invest/">How To Invest With Student Loans</a></li>
<li id="menu-item-83782" class="menu-item"><a href="#">Tax Loss Harvesting for Student Loans</a></li>
<li id="menu-item-83783" class="menu-item"><a href="#">Investing Guides</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Courses</h3>
									<ul id="menu-courses" class="sub-menu"><li id="menu-item-83784" class="menu-item"><a href="https://www.studentloanplanner.com/planning">Dreams, Not Debt (DIY Financial Planning)</a></li>
<li id="menu-item-83785" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/investing">Six Figure Debt to Six Figure Net Worth (DIY Investing)</a></li>
</ul>								</div> 
															</div>
											</li>

					
					<li class="main-nav-link-li 
					has-submenus submenu-column__three column 3 titles 3 columns					">
					
													<button aria-label="About" type="button" class="menu-item-main-link 
															" data-toggle="About" aria-expanded="false">
								About								<span class="chevron">
									<img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/arrow-up-green.svg" alt="chevron arrow">
								</span>
							</button>
							
												
													<div class="sub_menu" id="About-submenu">
								<button class="sub_menu_back" aria-label="Back to Menu" aria-expanded="false">
									<span class="sub_menu_back__icon"></span>
									<span class="sub_menu_back__text">Back to All</span>
								</button>
								<button type="button" class="nav-icon open" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>

								<div class="sub_menu_dropdown__title">
									About								</div>
								
															
								<div class="menu-column">
									<h3 class="menu-column_title ">About SLP</h3>
									<ul id="menu-about-slp" class="sub-menu"><li id="menu-item-83372" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/about-us/">About us</a></li>
<li id="menu-item-83369" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/about-us/team/">Our Team</a></li>
<li id="menu-item-83370" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/reviews/">Reviews</a></li>
<li id="menu-item-83371" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/press/">In the News</a></li>
<li id="menu-item-83957" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/podcast/">Podcast</a></li>
<li id="menu-item-83373" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/press-kit/">Press Kit</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Engage With Us</h3>
									<ul id="menu-engage-with-us" class="sub-menu"><li id="menu-item-82593" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/speaking/">For Employers</a></li>
<li id="menu-item-83788" class="menu-item"><a>For Schools</a></li>
<li id="menu-item-83789" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/speaking/">For Student Groups</a></li>
<li id="menu-item-83790" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/speaking/">For Organizations</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Presentations</h3>
									<ul id="menu-presentations" class="sub-menu"><li id="menu-item-83787" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/speaking/">Get a Free Webinar</a></li>
</ul>								</div> 
																
								<div class="menu-column">
									<h3 class="menu-column_title ">Contact</h3>
									<ul id="menu-contact" class="sub-menu"><li id="menu-item-83376" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/contact/">Contact Us</a></li>
<li id="menu-item-83377" class="menu-item"><a href="https://studentloanprd.wpenginepowered.com/press/">Press Contact</a></li>
</ul>								</div> 
															</div>
											</li>

												
			</ul>

			<div class="search-popup" id="search-modal" role="dialog" aria-modal="true">
				<form action="/" method="get">
					<div class="under_line">
						<img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20width='0'%20height='0'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="search" aria-hidden="true" class="perfmatters-lazy" data-src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/search-white.svg"><noscript><img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/search-white.svg" alt="search" aria-hidden="true"></noscript>
						<div class="input-group">
							<input type="text" name="s" id="modal_search" value="">
							<label for="modal_search">Search for tools, occupations, resources, etc....</label>
						</div>
					</div>
					<button class="btn" type="submit">Search</button>
				</form>
				<button class="close" id="close-search"> 
					<img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20width='0'%20height='0'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="close search" class="perfmatters-lazy" data-src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/close-cross-white.svg"><noscript><img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/close-cross-white.svg" alt="close search"></noscript>
				</button>
			</div>

			<div class="menu_desktop">
				<button class="menu_search_btn " id="menu_search_btn" aria-haspopup="dialog" aria-controls="search-modal" aria-expanded="false">
					<img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/search-white.svg" alt="search" class="perfmatters-lazy entered pmloaded" data-src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/search-white.svg" data-ll-status="loaded"><noscript><img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/search-white.svg" alt="search"></noscript>
				</button>

														<a href="https://studentloanprd.wpenginepowered.com/hire-student-loan-help/" class="btn br-ten">
						Get Help					</a>
												</div>

			<div class="menu_bottom">
				<div class="mobile_search">
					<form action="/" method="get">
						<img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20width='0'%20height='0'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="search" class="perfmatters-lazy" data-src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/search-white.svg"><noscript><img src="https://studentloanprd.wpenginepowered.com/wp-content/themes/student-loan-planner-theme/assets/icons/utility/search-white.svg" alt="search"></noscript>
						<input type="text" name="s" placeholder="" id="search" value="">
						<label for="search">Search for tools, occupations, resources, etc....</label>
					</form>
				</div>
				<div class="mobile_help_btn">

																	<a href="https://studentloanprd.wpenginepowered.com/hire-student-loan-help/" class="btn">
							Get Help						</a>
											
				</div>
			</div>

		</nav>
	</div>
</div>


<?php if ( ! empty( $link_data ) ) : ?>
	<a href="<?php echo ! empty( $link_data ) ? $link_data['url'] : ''; ?>" <?php echo ! empty( $link_data['target'] ) ? 'target="' . $link_data['target'] . '"' : ''; ?> class="btn br-ten mobile-header-link">
		<?php echo ! empty( $link_data ) ? $link_data['title'] : 'Get Help'; ?>
	</a>
<?php else : ?>
	<?php if ( ! empty( $header_main_link ) ) : ?>
	<a href="<?php echo ! empty( $header_main_link ) ? $header_main_link['url'] : ''; ?>" <?php echo ! empty( $header_main_link['target'] ) ? 'target="' . $header_main_link['target'] . '"' : ''; ?> class="btn br-ten mobile-header-link">
		<?php echo ! empty( $header_main_link ) ? $header_main_link['title'] : 'Get Help'; ?>
	</a>
	<?php endif; ?>
<?php endif; ?>