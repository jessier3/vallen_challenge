<?php

namespace MagazineBundle\MagazineBundle\Base;

use \Exception;
use \PDO;
use MagazineBundle\MagazineBundle\Issue as ChildIssue;
use MagazineBundle\MagazineBundle\IssueQuery as ChildIssueQuery;
use MagazineBundle\MagazineBundle\Map\IssueTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'issue' table.
 *
 *
 *
 * @method     ChildIssueQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildIssueQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method     ChildIssueQuery orderByDatePublication($order = Criteria::ASC) Order by the date_publication column
 * @method     ChildIssueQuery orderByCover($order = Criteria::ASC) Order by the cover column
 * @method     ChildIssueQuery orderByPublicationId($order = Criteria::ASC) Order by the publication_id column
 *
 * @method     ChildIssueQuery groupById() Group by the id column
 * @method     ChildIssueQuery groupByNumber() Group by the number column
 * @method     ChildIssueQuery groupByDatePublication() Group by the date_publication column
 * @method     ChildIssueQuery groupByCover() Group by the cover column
 * @method     ChildIssueQuery groupByPublicationId() Group by the publication_id column
 *
 * @method     ChildIssueQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildIssueQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildIssueQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildIssueQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildIssueQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildIssueQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildIssueQuery leftJoinPublication($relationAlias = null) Adds a LEFT JOIN clause to the query using the Publication relation
 * @method     ChildIssueQuery rightJoinPublication($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Publication relation
 * @method     ChildIssueQuery innerJoinPublication($relationAlias = null) Adds a INNER JOIN clause to the query using the Publication relation
 *
 * @method     ChildIssueQuery joinWithPublication($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Publication relation
 *
 * @method     ChildIssueQuery leftJoinWithPublication() Adds a LEFT JOIN clause and with to the query using the Publication relation
 * @method     ChildIssueQuery rightJoinWithPublication() Adds a RIGHT JOIN clause and with to the query using the Publication relation
 * @method     ChildIssueQuery innerJoinWithPublication() Adds a INNER JOIN clause and with to the query using the Publication relation
 *
 * @method     \MagazineBundle\MagazineBundle\PublicationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildIssue findOne(ConnectionInterface $con = null) Return the first ChildIssue matching the query
 * @method     ChildIssue findOneOrCreate(ConnectionInterface $con = null) Return the first ChildIssue matching the query, or a new ChildIssue object populated from the query conditions when no match is found
 *
 * @method     ChildIssue findOneById(int $id) Return the first ChildIssue filtered by the id column
 * @method     ChildIssue findOneByNumber(int $number) Return the first ChildIssue filtered by the number column
 * @method     ChildIssue findOneByDatePublication(string $date_publication) Return the first ChildIssue filtered by the date_publication column
 * @method     ChildIssue findOneByCover(string $cover) Return the first ChildIssue filtered by the cover column
 * @method     ChildIssue findOneByPublicationId(int $publication_id) Return the first ChildIssue filtered by the publication_id column *

 * @method     ChildIssue requirePk($key, ConnectionInterface $con = null) Return the ChildIssue by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIssue requireOne(ConnectionInterface $con = null) Return the first ChildIssue matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIssue requireOneById(int $id) Return the first ChildIssue filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIssue requireOneByNumber(int $number) Return the first ChildIssue filtered by the number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIssue requireOneByDatePublication(string $date_publication) Return the first ChildIssue filtered by the date_publication column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIssue requireOneByCover(string $cover) Return the first ChildIssue filtered by the cover column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIssue requireOneByPublicationId(int $publication_id) Return the first ChildIssue filtered by the publication_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIssue[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildIssue objects based on current ModelCriteria
 * @method     ChildIssue[]|ObjectCollection findById(int $id) Return ChildIssue objects filtered by the id column
 * @method     ChildIssue[]|ObjectCollection findByNumber(int $number) Return ChildIssue objects filtered by the number column
 * @method     ChildIssue[]|ObjectCollection findByDatePublication(string $date_publication) Return ChildIssue objects filtered by the date_publication column
 * @method     ChildIssue[]|ObjectCollection findByCover(string $cover) Return ChildIssue objects filtered by the cover column
 * @method     ChildIssue[]|ObjectCollection findByPublicationId(int $publication_id) Return ChildIssue objects filtered by the publication_id column
 * @method     ChildIssue[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
class IssueQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \MagazineBundle\MagazineBundle\Base\IssueQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\MagazineBundle\\MagazineBundle\\Issue', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildIssueQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildIssueQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildIssueQuery) {
            return $criteria;
        }
        $query = new ChildIssueQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildIssue|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(IssueTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = IssueTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIssue A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, number, date_publication, cover, publication_id FROM issue WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildIssue $obj */
            $obj = new ChildIssue();
            $obj->hydrate($row);
            IssueTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildIssue|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildIssueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(IssueTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildIssueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(IssueTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIssueQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(IssueTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(IssueTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IssueTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the number column
     *
     * Example usage:
     * <code>
     * $query->filterByNumber(1234); // WHERE number = 1234
     * $query->filterByNumber(array(12, 34)); // WHERE number IN (12, 34)
     * $query->filterByNumber(array('min' => 12)); // WHERE number > 12
     * </code>
     *
     * @param     mixed $number The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIssueQuery The current query, for fluid interface
     */
    public function filterByNumber($number = null, $comparison = null)
    {
        if (is_array($number)) {
            $useMinMax = false;
            if (isset($number['min'])) {
                $this->addUsingAlias(IssueTableMap::COL_NUMBER, $number['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($number['max'])) {
                $this->addUsingAlias(IssueTableMap::COL_NUMBER, $number['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IssueTableMap::COL_NUMBER, $number, $comparison);
    }

    /**
     * Filter the query on the date_publication column
     *
     * Example usage:
     * <code>
     * $query->filterByDatePublication('2011-03-14'); // WHERE date_publication = '2011-03-14'
     * $query->filterByDatePublication('now'); // WHERE date_publication = '2011-03-14'
     * $query->filterByDatePublication(array('max' => 'yesterday')); // WHERE date_publication > '2011-03-13'
     * </code>
     *
     * @param     mixed $datePublication The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIssueQuery The current query, for fluid interface
     */
    public function filterByDatePublication($datePublication = null, $comparison = null)
    {
        if (is_array($datePublication)) {
            $useMinMax = false;
            if (isset($datePublication['min'])) {
                $this->addUsingAlias(IssueTableMap::COL_DATE_PUBLICATION, $datePublication['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datePublication['max'])) {
                $this->addUsingAlias(IssueTableMap::COL_DATE_PUBLICATION, $datePublication['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IssueTableMap::COL_DATE_PUBLICATION, $datePublication, $comparison);
    }

    /**
     * Filter the query on the cover column
     *
     * Example usage:
     * <code>
     * $query->filterByCover('fooValue');   // WHERE cover = 'fooValue'
     * $query->filterByCover('%fooValue%', Criteria::LIKE); // WHERE cover LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cover The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIssueQuery The current query, for fluid interface
     */
    public function filterByCover($cover = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cover)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IssueTableMap::COL_COVER, $cover, $comparison);
    }

    /**
     * Filter the query on the publication_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPublicationId(1234); // WHERE publication_id = 1234
     * $query->filterByPublicationId(array(12, 34)); // WHERE publication_id IN (12, 34)
     * $query->filterByPublicationId(array('min' => 12)); // WHERE publication_id > 12
     * </code>
     *
     * @see       filterByPublication()
     *
     * @param     mixed $publicationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIssueQuery The current query, for fluid interface
     */
    public function filterByPublicationId($publicationId = null, $comparison = null)
    {
        if (is_array($publicationId)) {
            $useMinMax = false;
            if (isset($publicationId['min'])) {
                $this->addUsingAlias(IssueTableMap::COL_PUBLICATION_ID, $publicationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($publicationId['max'])) {
                $this->addUsingAlias(IssueTableMap::COL_PUBLICATION_ID, $publicationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IssueTableMap::COL_PUBLICATION_ID, $publicationId, $comparison);
    }

    /**
     * Filter the query by a related \MagazineBundle\MagazineBundle\Publication object
     *
     * @param \MagazineBundle\MagazineBundle\Publication|ObjectCollection $publication The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIssueQuery The current query, for fluid interface
     */
    public function filterByPublication($publication, $comparison = null)
    {
        if ($publication instanceof \MagazineBundle\MagazineBundle\Publication) {
            return $this
                ->addUsingAlias(IssueTableMap::COL_PUBLICATION_ID, $publication->getId(), $comparison);
        } elseif ($publication instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(IssueTableMap::COL_PUBLICATION_ID, $publication->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPublication() only accepts arguments of type \MagazineBundle\MagazineBundle\Publication or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Publication relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildIssueQuery The current query, for fluid interface
     */
    public function joinPublication($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Publication');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Publication');
        }

        return $this;
    }

    /**
     * Use the Publication relation Publication object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MagazineBundle\MagazineBundle\PublicationQuery A secondary query class using the current class as primary query
     */
    public function usePublicationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPublication($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Publication', '\MagazineBundle\MagazineBundle\PublicationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildIssue $issue Object to remove from the list of results
     *
     * @return $this|ChildIssueQuery The current query, for fluid interface
     */
    public function prune($issue = null)
    {
        if ($issue) {
            $this->addUsingAlias(IssueTableMap::COL_ID, $issue->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the issue table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IssueTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            IssueTableMap::clearInstancePool();
            IssueTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IssueTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(IssueTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            IssueTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            IssueTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // IssueQuery
