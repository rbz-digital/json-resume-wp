<?php

$basics = $sections['basics'];
$works = $sections['work'];
$educations = $sections['education'];
$certificates = $sections['certificates'];
$publications = $sections['publications'];
$skills = $sections['skills'];
$languages = $sections['languages'];
$interests = $sections['interests'];
$references = $sections['references'];

$links = array();
$links[] = array(
    'title' => __( 'Email', 'json-resume-wp' ),
    'text' => $basics['email'],
    'url' => 'mailto:'. $basics['email']
);
$links[] = array(
    'title' => __( 'Phone', 'json-resume-wp' ),
    'text' => $basics['phone'],
    'url' => 'tel:'. $basics['phone']
);
$links[] = array(
    'title' => __( 'Website', 'json-resume-wp' ),
    'text' => $basics['website'],
    'url' => $basics['website']
);
foreach ( $basics['profiles'] as $profile ) {
    
    $links[] = array(
        'title' => $profile['network'],
        'text' => '@'. $profile['username'],
        'url' => $profile['url']
    );
}
$qtd_links = 12 / count( $links );

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/octicons@8.5.0/build/build.min.css" rel="stylesheet">

<link rel="stylesheet" href="<?= JSON_Resume_WP_URL .'public/assets/css/json-resume-wp-styles.css' ?>">

	<header id="header" class="mb-5 resume">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-push-3">
					<h1 class="mb-1"><?= $basics['name'] ?></h1>
					<h2 class="text-muted mb-1"><?= $basics['label'] ?></h2>
				</div>
			</div>
		</div>
	</header>

    <div id="content" class="container resume">

		<section id="contact" class="row mb-5">
			<?php
			foreach ( $links as $link ) {
			?>
			<div class="col-<?= $qtd_links ?>">
				<dl>
					<dt><?= $link['title'] ?></dt>
					<dd>
						<a href="<?= $link['url'] ?>" target="_blank" rel="nofollow"><?= $link['text'] ?></a>
					</dd>
				</dl>
			</div>
			<?php
			}
			?>
		</section>

		<section id="about" class="row mb-5">
			<aside class="col-sm-3">
				<h3><?= __( 'About', 'json-resume-wp' ) ?></h3>
			</aside>
			<div class="col-sm-9">
				<p><?= $basics['summary'] ?></p>
			</div>
		</section>

		<section id="skills" class="row mb-5">
			<aside class="col-sm-3">
				<h3><?= __( 'Skills', 'json-resume-wp' ) ?></h3>
			</aside>
			<div class="col-sm-9">
				<div class="row">
				<?php
				foreach ( $skills as $skill ) : 
				?>
				<div class="col-sm-3">
					<div class="name">
						<h4><?= $skill['name'] ?></h4>
					</div>
					<?php
					if ( $skill['keywords'] ) : 
					?>
					<ul class="keywords">
						<?php
						foreach ( $skill['keywords'] as $keyword ) : 
						?>
						<li class="bullet"><?= $keyword ?></li>
						<?php
						endforeach;
						?>
					</ul>
					<?php
					endif;
					?>
				</div>
				<?php
				endforeach;
				?>
				</div>
			</div>
		</section>

		<section id="work" class="row mb-5">
			<aside class="col-sm-3">
				<h3><?= __( 'Work', 'json-resume-wp' ) ?></h3>
			</aside>
			<div class="col-sm-9">
				<div class="row">
				<?php
				foreach ( $works as $work ) : 
				?>
				<div class="col-sm-12">
					<h4 class="strike-through">
						<span><?= $work['company'] ?></span>
						<span class="date">
							<?= $this->dt( $work['startDate'] ) ?> — 
							<?= 'today' === $work['endDate'] ? __( 'Today', 'json-resume-wp' ) : $this->dt( $work['endDate'] ) ?>
						</span>
					</h4>
					<div class="website pull-right">
						<a href="<?= $work['website'] ?>" target="_blank" rel="nofollow"><?= $work['website'] ?></a>
					</div>
					<div class="position">
						<?= $work['position'] ?>
					</div>
					<div class="summary">
						<p><?= $work['summary'] ?></p>
					</div>
					<?php
					if ( $work['highlights'] ) : 
					?>
					<h4><?= __( 'Highlights', 'json-resume-wp' ) ?></h4>
					<ul class="highlights">
						<?php
						foreach ( $work['highlights'] as $highlight ) : 
						?>
						<li class="bullet"><?= $highlight ?></li>
						<?php
						endforeach;
						?>
					</ul>
					<?php
					endif;
					?>
				</div>
				<?php
				endforeach; 
				?>
				</div>
			</div>
		</section>

		
		<section id="education" class="row mb-5">
			<aside class="col-sm-3">
				<h3><?= __( 'Education', 'json-resume-wp' ) ?></h3>
			</aside>
			<div class="col-sm-9">
				<div class="row">
				<?php
				foreach ( $educations as $education ) : 
				?>
				<div class="col-sm-12">
					<h4 class="strike-through">
						<span><?= $education['institution'] ?></span>
						<span class="date">
							<?= $this->dt( $education['startDate'] ) ?> — <?= 'suspended' === $education['endDate'] ? __( 'Suspended', 'json-resume-wp' ) : $this->dt( $education['endDate'] ) ?>
						</span>
					</h4>
					<div class="area">
						<?= $education['area'] ?>
					</div>
					<div class="studyType">
						<?= $education['studyType'] ?>
					</div>
					<?php
					if ( $education['summary'] ) : 
					?>
					<div class="summary">
						<?= $education['summary'] ?>
					</div>
					<?php
					endif;
					?>
					<?php
					if ( $education['courses'] ) : 
					?>
					<h5 class="courses_title"><?= __( 'Courses', 'json-resume-wp' ) ?></h5>
					<ul class="courses">
						<?php
						foreach ( $education['courses'] as $course ) : 
						?>
						<li class="bullet"><?= $course ?></li>
						<?php
						endforeach;
						?>
					</ul>
					<?php
					endif;
					?>
				</div>
				<?php
				endforeach;
				?>
				</div>
			</div>
		</section>
		
		<section id="certificates" class="row mb-5">
			<aside class="col-sm-3">
				<h3><?= __( 'Certificate', 'json-resume-wp' ) ?></h3>
			</aside>
			<div class="col-sm-9">
				<div class="row">
				<?php
				foreach ( $certificates as $certificate ) : 
				?>
				<div class="col-sm-12">
					<h4 class="strike-through">
						<span><?= $certificate['name'] ?></span>
						<span class="date">
							<?= $this->dt( $certificate['date'] ) ?>
						</span>
					</h4>
					<div class="url octicon-verified">
						<a href="<?= $certificate['url'] ?>" target="_blank" rel="nofollow">
							<?= $certificate['url'] ?>
						</a>
					</div>
				</div>
				<?php
				endforeach;
				?>
				</div>
			</div>
		</section>
		
		<section id="publications" class="row mb-5">
			<aside class="col-sm-3">
				<h3><?= __( 'Publications', 'json-resume-wp' ) ?></h3>
			</aside>
			<div class="col-sm-9">
				<div class="row">
				<?php
				foreach ( $publications as $publication ) : 
				?>
				<div class="col-sm-12">
					<h4 class="strike-through">
						<span><?= $publication['name'] ?></span>
						<span class="date">
							<?= $this->dt( $publication['releaseDate'] ) ?>
						</span>
					</h4>
					<div class="website pull-right">
						<a href="<?= $publication['website'] ?>" target="_blank" rel="nofollow">
							<?= $publication['website'] ?>
						</a>
					</div>
					<div class="publisher">
						<em><?= __( 'Published by', 'json-resume-wp' ) ?></em>
						<strong><?= $publication['publisher'] ?></strong>
					</div>
					<div class="summary">
						<p><?= $publication['summary'] ?></p>
					</div>
				</div>
				<?php
				endforeach;
				?>
				</div>
			</div>
		</section>

		<section id="languages" class="row mb-5">
			<aside class="col-sm-3">
				<h3><?= __( 'Languages', 'json-resume-wp' ) ?></h3>
			</aside>
			<div class="col-sm-9">
				<div class="row">
				<?php
				foreach ( $languages as $language ) : 
				?>
				<div class="col-sm-4">
					<div class="language">
						<strong><?= $language['language'] ?></strong>
					</div>
					<div class="fluency">
						<?= $language['fluency'] ?>
					</div>
				</div>
				<?php
				endforeach;
				?>
				</div>
			</div>
		</section>

		<section id="interests" class="row mb-5">
			<aside class="col-sm-3">
				<h3><?= __( 'Interests', 'json-resume-wp' ) ?></h3>
			</aside>
			<div class="col-sm-9">
				<div class="row">
				<?php
				foreach ( $interests as $interest ) : 
				?>
				<div class="col-sm-4">
					<div class="name">
						<h4><?= $interest['name'] ?></h4>
					</div>
					<?php
					if ( $interest['keywords'] ) : 
					?>
					<ul class="keywords">
						<?php
						foreach ( $interest['keywords'] as $keyword ) : 
						?>
						<li class="bullet"><?= $keyword ?></li>
						<?php
						endforeach;
						?>
					</ul>
					<?php
					endif;
					?>
				</div>
				<?php
				endforeach;
				?>
				</div>
			</div>
		</section>
		
		<section id="references" class="row mb-5">
			<aside class="col-sm-3">
				<h3><?= __( 'References', 'json-resume-wp' ) ?></h3>
			</aside>
			<div class="col-sm-9">
				<div class="row">
				<?php
				foreach ( $references as $reference ) : 
				?>
				<div class="col-sm-12">
					<blockquote class="reference">
						<p><?= $reference['reference'] ?></p>
						<p class="name">
							<strong>— <?= $reference['name'] ?></strong>
						</p>
					</blockquote>
				</div>
				<?php
				endforeach;
				?>
				</div>
			</div>
		</section>

	</div>

<?php