<?php

namespace Anax\Anax;
 
/**
 * Model for Users.
 *
 */
class CDatabaseModel implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
		
		/**
		 * Get the table name.
		 *
		 * @return string with the table name.
		 */
		public function getSource()
		{
		    return strtolower(implode('', array_slice(explode('\\', get_class($this)), -1)));
		}
	
		/**
		 * Find and return all.
		 *
		 * @return array
		 */
		public function findAll()
		{
		    $this->db->select()
		             ->from($this->getSource());
 
		    $this->db->execute();
		    $this->db->setFetchModeClass(__CLASS__);
		    return $this->db->fetchAll();
		}
		
		public function lastInsertId() {
			return $this->db->lastInsertId();
		}
		
		public function setup() {
			
			$this->db->dropTableIfExists('users')->execute();
 
			    $this->db->createTable(
			        'users',
			        [
			            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
			            'acronym' => ['varchar(20)', 'unique', 'not null'],
			            'email' => ['varchar(80)'],
			            'firstname' => ['varchar(80)'],
									'lastname' => ['varchar(80)'],
			            'password' => ['varchar(255)'],
			            'created' => ['datetime'],
			        ]
			    )->execute();
							
							$this->db->insert(
							        'users',
							        ['acronym', 'email', 'firstname', 'lastname', 'password', 'created']
							    );
 
							    $now = date("Y-m-d H:i:s");
 
							    $this->db->execute([
							        'admin',
							        'admin@dbwebb.se',
							        'Administrator',
											'Babic',
							        password_hash('admin', PASSWORD_DEFAULT),
							        $now
							    ]);
 
							    $this->db->execute([
							        'doe',
							        'doe@dbwebb.se',
							        'John',
											'Doe',
							        password_hash('doe', PASSWORD_DEFAULT),
							        $now
							    ]);
			
			
			
			
			$this->db->dropTableIfExists('questions')->execute();
	    $this->db->createTable(
	        'questions',
					[  
					            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],  
					            'user' => ['varchar(20)'],  
											'title' => ['varchar(80)'],  
					            'content' => ['text'],
					            'created' => ['datetime'],
					        ]  
	    )->execute();
									
									$this->db->insert(
									        'questions',
									        ['title', 'user', 'content', 'created']
									    );
 
									    $now = date("Y-m-d H:i:s");
 
									    $this->db->execute([
									        'Varför kan inte människor flyga?',
									        'admin',
									        'Hur kommer det sig att alla andra kan flyga förutom vi?',
									        $now
									    ]);
													
											    $this->db->execute([
											        'Jag kissar på mig?',
											        'admin',
											        'Varför kissar jag på mig så ofta jämtemot alla andra?',
											        $now
											    ]);
 
									    $this->db->execute([
									        'Vad är 9 + 10?',
									        'doe',
									        'Jag har blivit jätteförvirrad, jag frågade min lärare vad 9 + 10 är och han svarade 19.... 9 + 10  är väl 21?',
									        $now
									    ]);
										
				$this->db->dropTableIfExists('answers')->execute();

				    $this->db->createTable(
				        'answers',
				        [
				            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
				            'question' => ['integer'],
				            'user' => ['varchar(20)'],
				            'content' => ['text'],
				            'created' => ['datetime'],
				        ]
				    )->execute();

								$this->db->insert(
								        'answers',
								        ['question', 'user', 'content', 'created']
								    );

								    $now = date("Y-m-d H:i:s");

								    $this->db->execute([
								        1,
								        'doe',
								        'The theoretical of the premiss is still not proven...',
								        $now
								    ]);
												
										    $this->db->execute([
										        2,
										        'admin',
										        'The theoretical of the premiss is still not proven...',
										        $now
										    ]);

								    $this->db->execute([
								        1,
								        'admin',
								        'The theoretical of the premiss was proven years ago...',
								        $now
								    ]);
												
										    $this->db->execute([
										        1,
										        'admin',
										        'Or was it?',
										        $now
										    ]);
												
											
				$this->db->dropTableIfExists('comments')->execute();

				    $this->db->createTable(
				        'comments',
				        [
				            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
				            'type' => ['varchar(20)'],
				            'user' => ['varchar(20)'],
				            'content' => ['text'],
										'linkid' => ['integer'],
				            'created' => ['datetime'],
				        ]
				    )->execute();

								$this->db->insert(
								        'comments',
								        ['type', 'user', 'content', 'linkid', 'created']
								    );

								    $now = date("Y-m-d H:i:s");

								    $this->db->execute([
								        'question',
								        'doe',
								        'You suck',
												1,
								        $now
								    ]);
												
								    $this->db->execute([
								        'question',
								        'admin',
								        'NO! You suck!',
												1,
								        $now
								    ]);

								    $this->db->execute([
								        'answer',
								        'admin',
								        'You suck!',
												1,
								        $now
								    ]);
												
										    $this->db->execute([
										        'answer',
										        'doe',
										        'NO, you suck!',
														1,
										        $now
										    ]);
												
												$this->db->dropTableIfExists('taggar')->execute();

												    $this->db->createTable(
												        'taggar',
												        [
												            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
												            'tag' => ['varchar(20)'],
																		'linkid' => ['integer'],
												        ]
												    )->execute();

																$this->db->insert(
																        'taggar',
																        ['tag', 'linkid']
																    );


																    $this->db->execute([
																        'random',
																				1
																    ]);
												
																    $this->db->execute([
																        'stupid',
																				1
																    ]);

																    $this->db->execute([
																        'aerodynamics',
																				1
																    ]);
																		
																    $this->db->execute([
																        'stupid',
																				2
																    ]);

												 	
		}
	
		/**
		 * Get object properties.
		 *
		 * @return array with object properties.
		 */
		public function getProperties()
		{
		    $properties = get_object_vars($this);
		    unset($properties['di']);
		    unset($properties['db']);
 
		    return $properties;
		}
		
		/**
		 * Find and return specific.
		 *
		 * @return this
		 */
		public function find($id)
		{
		    $this->db->select()
		             ->from($this->getSource())
		             ->where("id = ?");
 
		    $this->db->execute([$id]);
		    return $this->db->fetchAll();
		}
		
		/**
		 * Save current object/row.
		 *
		 * @param array $values key/values to save or empty to use object properties.
		 *
		 * @return boolean true or false if saving went okey.
		 */
		public function save($values = [])
		{
		    $this->setProperties($values);
		    $values = $this->getProperties();
 
		    if (isset($values['id'])) {
		        return $this->update($values);
		    } else {
		        return $this->create($values);
		    }
		}
		
		/**
		 * Set object properties.
		 *
		 * @param array $properties with properties to set.
		 *
		 * @return void
		 */
		public function setProperties($properties)
		{
		    // Update object with incoming values, if any
		    if (!empty($properties)) {
		        foreach ($properties as $key => $val) {
		            $this->$key = $val;
		        }
		    }
		}
		
		/**
		 * Create new row.
		 *
		 * @param array $values key/values to save.
		 *
		 * @return boolean true or false if saving went okey.
		 */
		public function create($values)
		{
		    $keys   = array_keys($values);
		    $values = array_values($values);
 
		    $this->db->insert(
		        $this->getSource(),
		        $keys
		    );
 
		    $res = $this->db->execute($values);
 
		    $this->id = $this->db->lastInsertId();
 
		    return $res;
		}
		
		/**
		 * Update row.
		 *
		 * @param array $values key/values to save.
		 *
		 * @return boolean true or false if saving went okey.
		 */
		public function update($values)
		{
		    $keys   = array_keys($values);
		    $values = array_values($values);
 
		    // Its update, remove id and use as where-clause
		    unset($keys['id']);
		    $values[] = $this->id;
 
		    $this->db->update(
		        $this->getSource(),
		        $keys,
		        "id = ?"
		    );
 
		    return $this->db->execute($values);
		}
		
		/**
		 * Delete row.
		 *
		 * @param integer $id to delete.
		 *
		 * @return boolean true or false if deleting went okey.
		 */
		public function delete($id)
		{
		    $this->db->delete(
		        $this->getSource(),
		        'id = ?'
		    );
 
		    return $this->db->execute([$id]);
		}
		
		/**
		 * Build a select-query.
		 *
		 * @param string $columns which columns to select.
		 *
		 * @return $this
		 */
		public function query($columns = '*')
		{
		    $this->db->select($columns)
		             ->from($this->getSource());
 
		    return $this;
		}
		
		/**
		 * Build the where part.
		 *
		 * @param string $condition for building the where part of the query.
		 *
		 * @return $this
		 */
		public function where($condition)
		{
		    $this->db->where($condition);
 
		    return $this;
		}
		
		/**
		 * Build the where part.
		 *
		 * @param string $condition for building the where part of the query.
		 *
		 * @return $this
		 */
		public function andWhere($condition)
		{
		    $this->db->andWhere($condition);
 
		    return $this;
		}
		
		public function orderBy($condition)
		{
		    $this->db->orderBy($condition);
 
		    return $this;
		}
		
		public function limit($condition) {
				$this->db->limit($condition);
				
				return $this;
		}
		
		/**
		 * Execute the query built.
		 *
		 * @param string $query custom query.
		 *
		 * @return $this
		 */
		public function execute($params = [])
		{
		    $this->db->execute($this->db->getSQL(), $params);
		    $this->db->setFetchModeClass(__CLASS__);
 
		    return $this->db->fetchAll();
		}
 
}