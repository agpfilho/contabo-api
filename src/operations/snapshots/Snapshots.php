<?php

namespace Alaahany\ContaboApi\operations\snapshots;

use Alaahany\ContaboApi\exceptions\ContaboException;
use Alaahany\ContaboApi\operations\Operation;

class Snapshots extends Operation
{
	
    public function __construct($contaboClient)
    {
        parent::__construct($contaboClient);
    }
	
    /**
     * List all snapshots.
     * GET /compute/v1/snapshots
     *
     * @param array $queryParameters Optional query parameters for filtering and pagination.
     * @return array
     */
    public function list(string $instanceId, array $queryParameters = []): array
    {
        return (array) $this->client->execute('get', "/v1/compute/instances/{$instanceId}/snapshots", $queryParameters);
    }

    /**
     * Create a new snapshot.
     * POST /compute/v1/snapshots
     *
     * @param int $instanceId The ID of the instance to create the snapshot from.
     * @param string $name The name of the snapshot.
     * @return array
     */
    public function create(string $instanceId, string $name, string $description): array
    {
        $data = [
					"name" => $name,
					"description" => $description
        ];

        return (array) $this->client->execute('post', '/v1/compute/instances/{$instanceId}/snapshots', $data);
    }

    /**
     * Retrieve a specific snapshot.
     * GET /compute/v1/snapshots/{snapshotId}
     *
     * @param int $snapshotId The ID of the snapshot to retrieve.
     * @return array
     */
    public function retrieve(string $instanceId, string $snapshotId): array
    {
        return $this->client->execute('get', "/v1/compute/instances/{$instanceId}/snapshots/{$snapshotId}");
    }

    /**
     * Update a specific snapshot (e.g., change name).
     * PATCH /compute/v1/snapshots/{snapshotId}
     *
     * @param int $snapshotId The ID of the snapshot to update.
     * @param string $name The new name for the snapshot.
     * @return array
     */
    public function update(string $instanceId, string $snapshotId, string $name): array
    {
        $data = [
            'name' => $name,
        ];

				return $this->client->execute('patch', "/v1/compute/instances/{$instanceId}/snapshots/{$snapshotId}", $data);
    }

    /**
     * Delete a specific snapshot.
     * DELETE /compute/v1/snapshots/{snapshotId}
     *
     * @param int $snapshotId The ID of the snapshot to delete.
     * @return array
     */
    public function delete(string $instanceId, string $snapshotId): array
    {
        return $this->client->execute('delete',"/v1/compute/instances/{$instanceId}/snapshots/{$snapshotId}");
    }

    /**
     * Revert an instance to a specific snapshot.
     * POST /compute/v1/snapshots/{snapshotId}/revert
     *
     * @param int $snapshotId The ID of the snapshot to revert to.
     * @return array
     */
    public function revert(string $instanceId, string $snapshotId): array
    {
        // The Contabo API documentation for revert is a POST request to /revert
        // with an empty body or a body that might contain a confirmation flag.
        // Assuming an empty body for now, as the API documentation is not fully explicit on the body.
        // If the API requires a body, this method will need adjustment.
        return $this->client->execute('post',"/v1/compute/instances/{$instanceId}/snapshots/{$snapshotId}/rollback");
    }
}
