<?php

namespace App\Traits\Admin;

use App\Enums\ExceptionMessage;
use App\Exceptions\ResourcesNotFoundException;
use App\Models\Coach;
use App\Models\PlayerGroup;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Inertia\Inertia;

trait AdminPlayerGroupTrait
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index_player_groups()
    {
        try {
            $playerGroups = PlayerGroup::with(['coaches', 'players'])->get();

            return Inertia::render('Admin/PlayerGroups/List', [
                'playerGroups' => $playerGroups,
                'coaches' => Coach::all(),
            ]);
        } catch (RelationNotFoundException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Coaches or Players'), null, 500, $e);
        } catch (QueryException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::QueryFailed('Groups'), null, 500, $e);
        } catch (Exception $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id The player group ID.
     * @return \Inertia\Response
     */
    public function show_player_group($id)
    {
        try {
            $playerGroup = PlayerGroup::with('coaches')->findOrFail($id);

            return Inertia::render('Admin/PlayerGroups/Show', [
                'playerGroup' => $playerGroup,
                'coaches' => Coach::all(),
            ]);
        } catch (ModelNotFoundException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::ResourceNotFound('Group'), null, 500, $e);
        } catch (Exception $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }

    /**
     * Update the specified player group.
     * 
     * @param \Illuminate\Http\Request $request The HTTP request.
     * @param int $id The player group ID.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_player_group($request, $id)
    {
        try {
            $playerGroup = PlayerGroup::with('coaches')->findOrFail($id);
            $data = $request->validated();
            $updateData = array_filter($data, function ($value, $key) use ($playerGroup) {
                return $playerGroup->{$key} !== $value;
            }, ARRAY_FILTER_USE_BOTH);

            if (isset($updateData['coaches'])) {
                $playerGroup->coaches()->sync($updateData['coaches']);
                unset($updateData['coaches']);
            }

            $playerGroup->update($updateData);

            return redirect()->route('admin.dashboard.groups.index')->with('message', 'Grup actualizat cu succes!');
        } catch (ModelNotFoundException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::ResourceNotFound('Group'), null, 500, $e);
        } catch (QueryException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::QueryFailed('Group'), null, 500, $e);
        } catch (Exception $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::GeneralUpdateResourceError(), null, 500, $e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request The HTTP request.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy_player_group($id)
    {
        try {
            $playerGroup = PlayerGroup::findOrFail($id);
            $playerGroup->delete();

            return redirect()->route('admin.dashboard.groups.index')->with('message', 'Grup șters cu succes!');
        } catch (ModelNotFoundException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::ResourceNotFound('Group'), null, 500, $e);
        } catch (QueryException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::QueryFailed('Group'), null, 500, $e);
        } catch (Exception $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }
}
