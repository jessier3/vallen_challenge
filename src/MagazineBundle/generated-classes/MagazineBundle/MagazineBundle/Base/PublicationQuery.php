<?php

namespace MagazineBundle\MagazineBundle\Base;

use \Exception;
use \PDO;
use MagazineBundle\MagazineBundle\Publication as ChildPublication;
use MagazineBundle\MagazineBundle\PublicationQuery as ChildPublicationQuery;
use MagazineBundle\MagazineBundle\Map\PublicationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'publication' table.
 *
 *
 *
 * @method     ChildPublicationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPublicationQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ChildPublicationQuery groupById() Group by the id column
 * @method     ChildPublicationQuery groupByName() Group by the name column
 *
 * @method     ChildPublicationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPublicationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPublicationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPublicationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPublicationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPublicationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPublicationQuery leftJoinIssue($relationAlias = null) Adds a LEFT JOIN clause to the query using the Issue relation
 * @method     ChildPublicationQuery rightJoinIssue($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Issue relation
 * @method     ChildPublicationQuery innerJoinIssue($relationAlias = null) Adds a INNER JOIN clause to the query using the Issue relation
 *
 * @method     ChildPublicationQuery joinWithIssue($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Issue relation
 *
 * @method     ChildPublicationQuery leftJoinWithIssue() Adds a LEFT JOIN clause and with to the query using the Issue relation
 * @method     ChildPublicationQuery rightJoinWithIssue() Adds a RIGHT JOIN clause and with to the query using the Issue relation
 * @method     ChildPublicationQuery innerJoinWithIssue() Adds a INNER JOIN clause and with to the query using the Issue relation
 *
 * @method     \MagazineBundle\MagazineBundle\IssueQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPublication findOne(ConnectionInterface $con = null) Return the first ChildPublication matching the query
 * @method     ChildPublication findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPublication matching the query, or a new ChildPublication object populated from the query conditions when no match is found
 *
 * @method     ChildPublication findOneById(int $id) Return the first ChildPublication filtered by the id column
 * @method     ChildPublication findOneByName(string $name) Return the first ChildPublication filtered by the name column *

 * @method     ChildPublication requirePk($key, ConnectionInterface $con = null) Return the ChildPublication by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPublication requireOne(ConnectionInterface $con = null) Return the first ChildPublication matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPublication requireOneById(int $id) Return the first ChildPublication filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPublication requireOneByName(string $name) Return the first ChildPublication filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPublication[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPublication objects based on current ModelCriteria
 * @method     ChildPublication[]|ObjectCollection findById(int $id) Return ChildPublication objects filtered by the id column
 * @method     ChildPublication[]|ObjectCollection findByName(string $name) Return ChildPublication objects filtered by the name column
 * @method     ChildPublication[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
class PublicationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \MagazineBundle\MagazineBundle\Base\PublicationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\MagazineBundle\\MagazineBundle\\Publication', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPublicationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPublicationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPublicationQuery) {
            return $criteria;
        }
        $query = new ChildPublicationQuery();
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
     * @return ChildPublication|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PublicationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PublicationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPublication A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name FROM publication WHERE id = :p0';
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
            /** @var ChildPublication $obj */
            $obj = new ChildPublication();
            $obj->hydrate($row);
            PublicationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPublication|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPublicationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PublicationTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPublicationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PublicationTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPublicationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PublicationTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PublicationTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PublicationTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPublicationQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PublicationTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related \MagazineBundle\MagazineBundle\Issue object
     *
     * @param \MagazineBundle\MagazineBundle\Issue|ObjectCollection $issue the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPublicationQuery The current query, for fluid interface
     */
    public function filterByIssue($issue, $comparison = null)
    {
        if ($issue instanceof \MagazineBundle\MagazineBundle\Issue) {
            return $this
                ->addUsingAlias(PublicationTableMap::COL_ID, $issue->getPublicationId(), $comparison);
        } elseif ($issue instanceof ObjectCollection) {
            return $this
                ->useIssueQuery()
                ->filterByPrimaryKeys($issue->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByIssue() only accepts arguments of type \MagazineBundle\MagazineBundle\Issue or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Issue relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPublicationQuery The current query, for fluid interface
     */
    public function joinIssue($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Issue');

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
            $this->addJoinObject($join, 'Issue');
        }

        return $this;
    }

    /**
     * Use the Issue relation Issue object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MagazineBundle\MagazineBundle\IssueQuery A secondary query class using the current class as primary query
     */
    public function useIssueQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIssue($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Issue', '\MagazineBundle\MagazineBundle\IssueQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPublication $publication Object to remove from the list of results
     *
     * @return $this|ChildPublicationQuery The current query, for fluid interface
     */
    public function prune($publication = null)
    {
        if ($publication) {
            $this->addUsingAlias(PublicationTableMap::COL_ID, $publication->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the publication table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PublicationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PublicationTableMap::clearInstancePool();
            PublicationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PublicationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PublicationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PublicationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PublicationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PublicationQuery
