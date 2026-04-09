===source===
<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\User;
use App\Database\Connection as DB;
use function App\Helpers\sanitize;

interface RepositoryInterface
{
    public function find(int $id): ?User;
    public function findAll(): array;
    public function save(User $user): void;
    public function delete(int $id): void;
}

abstract class AbstractRepository
{
    protected readonly DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    abstract protected function tableName(): string;
    abstract protected function hydrate(array $row): object;

    final public function count(): int
    {
        $result = $this->db->query('SELECT COUNT(*) FROM ' . $this->tableName());
        return (int)$result[0];
    }
}

class UserRepository extends AbstractRepository implements RepositoryInterface
{
    use Cacheable, Loggable;

    public const PER_PAGE = 25;
    private static int $queryCount = 0;

    protected function tableName(): string
    {
        return 'users';
    }

    protected function hydrate(array $row): User
    {
        return new User(
            id: (int)$row['id'],
            name: $row['name'],
            email: $row['email'] ?? null,
        );
    }

    public function find(int $id): ?User
    {
        self::$queryCount++;
        $rows = $this->db->query('SELECT * FROM users WHERE id = ?');
        return isset($rows[0]) ? $this->hydrate($rows[0]) : null;
    }

    public function findAll(): array
    {
        self::$queryCount++;
        $rows = $this->db->query('SELECT * FROM ' . $this->tableName());
        return array_map(fn(array $row) => $this->hydrate($row), $rows);
    }

    public function findByEmail(string $email): ?User
    {
        $sanitized = sanitize($email);
        $users = $this->findAll();
        $filtered = array_filter(
            $users,
            function(User $u) use ($sanitized): bool {
                return $u->email === $sanitized;
            }
        );
        return $filtered[0] ?? null;
    }

    public function save(User $user): void
    {
        try {
            $this->db->query('INSERT INTO users VALUES (?)');
            $this->log('User saved: ' . $user->name);
        } catch (\PDOException $e) {
            $this->log('Save failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function delete(int $id): void
    {
        $user = $this->find($id) ?? throw new \RuntimeException('User not found');
        $this->db->query('DELETE FROM users WHERE id = ?');
        $this->log('User deleted: ' . $user->name);
    }

    public static function getQueryCount(): int
    {
        return self::$queryCount;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 27,
                  "end": 28,
                  "start_line": 2,
                  "start_col": 21
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 32,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "App",
              "Repository"
            ],
            "kind": "Qualified",
            "span": {
              "start": 42,
              "end": 56,
              "start_line": 4,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 32,
        "end": 59,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "App",
                  "Models",
                  "User"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 63,
                  "end": 78,
                  "start_line": 6,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 63,
                "end": 78,
                "start_line": 6,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 59,
        "end": 80,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "App",
                  "Database",
                  "Connection"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 84,
                  "end": 108,
                  "start_line": 7,
                  "start_col": 4
                }
              },
              "alias": "DB",
              "span": {
                "start": 84,
                "end": 113,
                "start_line": 7,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 80,
        "end": 115,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "App",
                  "Helpers",
                  "sanitize"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 128,
                  "end": 148,
                  "start_line": 8,
                  "start_col": 13
                }
              },
              "alias": null,
              "span": {
                "start": 128,
                "end": 148,
                "start_line": 8,
                "start_col": 13
              }
            }
          ]
        }
      },
      "span": {
        "start": 115,
        "end": 151,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Interface": {
          "name": "RepositoryInterface",
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "find",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "id",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 208,
                              "end": 211,
                              "start_line": 12,
                              "start_col": 25
                            }
                          }
                        },
                        "span": {
                          "start": 208,
                          "end": 211,
                          "start_line": 12,
                          "start_col": 25
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 208,
                        "end": 215,
                        "start_line": 12,
                        "start_col": 25
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "User"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 219,
                              "end": 223,
                              "start_line": 12,
                              "start_col": 36
                            }
                          }
                        },
                        "span": {
                          "start": 219,
                          "end": 223,
                          "start_line": 12,
                          "start_col": 36
                        }
                      }
                    },
                    "span": {
                      "start": 218,
                      "end": 223,
                      "start_line": 12,
                      "start_col": 35
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 187,
                "end": 229,
                "start_line": 12,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "findAll",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 256,
                          "end": 261,
                          "start_line": 13,
                          "start_col": 31
                        }
                      }
                    },
                    "span": {
                      "start": 256,
                      "end": 261,
                      "start_line": 13,
                      "start_col": 31
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 229,
                "end": 267,
                "start_line": 13,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "save",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "user",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "User"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 288,
                              "end": 293,
                              "start_line": 14,
                              "start_col": 25
                            }
                          }
                        },
                        "span": {
                          "start": 288,
                          "end": 293,
                          "start_line": 14,
                          "start_col": 25
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 288,
                        "end": 298,
                        "start_line": 14,
                        "start_col": 25
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 301,
                          "end": 305,
                          "start_line": 14,
                          "start_col": 38
                        }
                      }
                    },
                    "span": {
                      "start": 301,
                      "end": 305,
                      "start_line": 14,
                      "start_col": 38
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 267,
                "end": 311,
                "start_line": 14,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "delete",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "id",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 334,
                              "end": 337,
                              "start_line": 15,
                              "start_col": 27
                            }
                          }
                        },
                        "span": {
                          "start": 334,
                          "end": 337,
                          "start_line": 15,
                          "start_col": 27
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 334,
                        "end": 341,
                        "start_line": 15,
                        "start_col": 27
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 344,
                          "end": 348,
                          "start_line": 15,
                          "start_col": 37
                        }
                      }
                    },
                    "span": {
                      "start": 344,
                      "end": 348,
                      "start_line": 15,
                      "start_col": 37
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 311,
                "end": 350,
                "start_line": 15,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 151,
        "end": 351,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "AbstractRepository",
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": "db",
                  "visibility": "Protected",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "DB"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 412,
                          "end": 415,
                          "start_line": 20,
                          "start_col": 23
                        }
                      }
                    },
                    "span": {
                      "start": 412,
                      "end": 415,
                      "start_line": 20,
                      "start_col": 23
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 393,
                "end": 418,
                "start_line": 20,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "db",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "DB"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 453,
                              "end": 456,
                              "start_line": 22,
                              "start_col": 32
                            }
                          }
                        },
                        "span": {
                          "start": 453,
                          "end": 456,
                          "start_line": 22,
                          "start_col": 32
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 453,
                        "end": 459,
                        "start_line": 22,
                        "start_col": 32
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 475,
                                        "end": 480,
                                        "start_line": 24,
                                        "start_col": 8
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "db"
                                      },
                                      "span": {
                                        "start": 482,
                                        "end": 484,
                                        "start_line": 24,
                                        "start_col": 15
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 475,
                                  "end": 484,
                                  "start_line": 24,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "db"
                                },
                                "span": {
                                  "start": 487,
                                  "end": 490,
                                  "start_line": 24,
                                  "start_col": 20
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 475,
                            "end": 490,
                            "start_line": 24,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 475,
                        "end": 496,
                        "start_line": 24,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 425,
                "end": 503,
                "start_line": 22,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "tableName",
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 544,
                          "end": 550,
                          "start_line": 27,
                          "start_col": 45
                        }
                      }
                    },
                    "span": {
                      "start": 544,
                      "end": 550,
                      "start_line": 27,
                      "start_col": 45
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 503,
                "end": 556,
                "start_line": 27,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "hydrate",
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "row",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 592,
                              "end": 597,
                              "start_line": 28,
                              "start_col": 40
                            }
                          }
                        },
                        "span": {
                          "start": 592,
                          "end": 597,
                          "start_line": 28,
                          "start_col": 40
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 592,
                        "end": 602,
                        "start_line": 28,
                        "start_col": 40
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "object"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 605,
                          "end": 611,
                          "start_line": 28,
                          "start_col": 53
                        }
                      }
                    },
                    "span": {
                      "start": 605,
                      "end": 611,
                      "start_line": 28,
                      "start_col": 53
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 556,
                "end": 618,
                "start_line": 28,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "count",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": true,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 649,
                          "end": 652,
                          "start_line": 30,
                          "start_col": 35
                        }
                      }
                    },
                    "span": {
                      "start": 649,
                      "end": 652,
                      "start_line": 30,
                      "start_col": 35
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "result"
                                },
                                "span": {
                                  "start": 667,
                                  "end": 674,
                                  "start_line": 32,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 677,
                                              "end": 682,
                                              "start_line": 32,
                                              "start_col": 18
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "db"
                                            },
                                            "span": {
                                              "start": 684,
                                              "end": 686,
                                              "start_line": 32,
                                              "start_col": 25
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 677,
                                        "end": 686,
                                        "start_line": 32,
                                        "start_col": 18
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "query"
                                      },
                                      "span": {
                                        "start": 688,
                                        "end": 693,
                                        "start_line": 32,
                                        "start_col": 29
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Binary": {
                                              "left": {
                                                "kind": {
                                                  "String": "SELECT COUNT(*) FROM "
                                                },
                                                "span": {
                                                  "start": 694,
                                                  "end": 717,
                                                  "start_line": 32,
                                                  "start_col": 35
                                                }
                                              },
                                              "op": "Concat",
                                              "right": {
                                                "kind": {
                                                  "MethodCall": {
                                                    "object": {
                                                      "kind": {
                                                        "Variable": "this"
                                                      },
                                                      "span": {
                                                        "start": 720,
                                                        "end": 725,
                                                        "start_line": 32,
                                                        "start_col": 61
                                                      }
                                                    },
                                                    "method": {
                                                      "kind": {
                                                        "Identifier": "tableName"
                                                      },
                                                      "span": {
                                                        "start": 727,
                                                        "end": 736,
                                                        "start_line": 32,
                                                        "start_col": 68
                                                      }
                                                    },
                                                    "args": []
                                                  }
                                                },
                                                "span": {
                                                  "start": 720,
                                                  "end": 738,
                                                  "start_line": 32,
                                                  "start_col": 61
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 694,
                                            "end": 738,
                                            "start_line": 32,
                                            "start_col": 35
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 694,
                                          "end": 738,
                                          "start_line": 32,
                                          "start_col": 35
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 677,
                                  "end": 739,
                                  "start_line": 32,
                                  "start_col": 18
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 667,
                            "end": 739,
                            "start_line": 32,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 667,
                        "end": 749,
                        "start_line": 32,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Cast": [
                              "Int",
                              {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "result"
                                      },
                                      "span": {
                                        "start": 761,
                                        "end": 768,
                                        "start_line": 33,
                                        "start_col": 20
                                      }
                                    },
                                    "index": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 769,
                                        "end": 770,
                                        "start_line": 33,
                                        "start_col": 28
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 761,
                                  "end": 771,
                                  "start_line": 33,
                                  "start_col": 20
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 756,
                            "end": 771,
                            "start_line": 33,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 749,
                        "end": 777,
                        "start_line": 33,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 618,
                "end": 779,
                "start_line": 30,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 362,
        "end": 780,
        "start_line": 18,
        "start_col": 9
      }
    },
    {
      "kind": {
        "Class": {
          "name": "UserRepository",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "AbstractRepository"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 811,
              "end": 830,
              "start_line": 37,
              "start_col": 29
            }
          },
          "implements": [
            {
              "parts": [
                "RepositoryInterface"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 841,
                "end": 861,
                "start_line": 37,
                "start_col": 59
              }
            }
          ],
          "members": [
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "Cacheable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 871,
                        "end": 880,
                        "start_line": 39,
                        "start_col": 8
                      }
                    },
                    {
                      "parts": [
                        "Loggable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 882,
                        "end": 890,
                        "start_line": 39,
                        "start_col": 19
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 867,
                "end": 897,
                "start_line": 39,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "PER_PAGE",
                  "visibility": "Public",
                  "value": {
                    "kind": {
                      "Int": 25
                    },
                    "span": {
                      "start": 921,
                      "end": 923,
                      "start_line": 41,
                      "start_col": 28
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 897,
                "end": 929,
                "start_line": 41,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "queryCount",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 944,
                          "end": 947,
                          "start_line": 42,
                          "start_col": 19
                        }
                      }
                    },
                    "span": {
                      "start": 944,
                      "end": 947,
                      "start_line": 42,
                      "start_col": 19
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 962,
                      "end": 963,
                      "start_line": 42,
                      "start_col": 37
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 929,
                "end": 963,
                "start_line": 42,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "tableName",
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 1002,
                          "end": 1008,
                          "start_line": 44,
                          "start_col": 36
                        }
                      }
                    },
                    "span": {
                      "start": 1002,
                      "end": 1008,
                      "start_line": 44,
                      "start_col": 36
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "String": "users"
                          },
                          "span": {
                            "start": 1030,
                            "end": 1037,
                            "start_line": 46,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 1023,
                        "end": 1043,
                        "start_line": 46,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 970,
                "end": 1050,
                "start_line": 44,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "hydrate",
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "row",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1077,
                              "end": 1082,
                              "start_line": 49,
                              "start_col": 31
                            }
                          }
                        },
                        "span": {
                          "start": 1077,
                          "end": 1082,
                          "start_line": 49,
                          "start_col": 31
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 1077,
                        "end": 1087,
                        "start_line": 49,
                        "start_col": 31
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "User"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 1090,
                          "end": 1099,
                          "start_line": 49,
                          "start_col": 44
                        }
                      }
                    },
                    "span": {
                      "start": 1090,
                      "end": 1099,
                      "start_line": 49,
                      "start_col": 44
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "User"
                                },
                                "span": {
                                  "start": 1120,
                                  "end": 1124,
                                  "start_line": 51,
                                  "start_col": 19
                                }
                              },
                              "args": [
                                {
                                  "name": "id",
                                  "value": {
                                    "kind": {
                                      "Cast": [
                                        "Int",
                                        {
                                          "kind": {
                                            "ArrayAccess": {
                                              "array": {
                                                "kind": {
                                                  "Variable": "row"
                                                },
                                                "span": {
                                                  "start": 1147,
                                                  "end": 1151,
                                                  "start_line": 52,
                                                  "start_col": 21
                                                }
                                              },
                                              "index": {
                                                "kind": {
                                                  "String": "id"
                                                },
                                                "span": {
                                                  "start": 1152,
                                                  "end": 1156,
                                                  "start_line": 52,
                                                  "start_col": 26
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1147,
                                            "end": 1157,
                                            "start_line": 52,
                                            "start_col": 21
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 1142,
                                      "end": 1157,
                                      "start_line": 52,
                                      "start_col": 16
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 1138,
                                    "end": 1157,
                                    "start_line": 52,
                                    "start_col": 12
                                  }
                                },
                                {
                                  "name": "name",
                                  "value": {
                                    "kind": {
                                      "ArrayAccess": {
                                        "array": {
                                          "kind": {
                                            "Variable": "row"
                                          },
                                          "span": {
                                            "start": 1177,
                                            "end": 1181,
                                            "start_line": 53,
                                            "start_col": 18
                                          }
                                        },
                                        "index": {
                                          "kind": {
                                            "String": "name"
                                          },
                                          "span": {
                                            "start": 1182,
                                            "end": 1188,
                                            "start_line": 53,
                                            "start_col": 23
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1177,
                                      "end": 1189,
                                      "start_line": 53,
                                      "start_col": 18
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 1171,
                                    "end": 1189,
                                    "start_line": 53,
                                    "start_col": 12
                                  }
                                },
                                {
                                  "name": "email",
                                  "value": {
                                    "kind": {
                                      "NullCoalesce": {
                                        "left": {
                                          "kind": {
                                            "ArrayAccess": {
                                              "array": {
                                                "kind": {
                                                  "Variable": "row"
                                                },
                                                "span": {
                                                  "start": 1210,
                                                  "end": 1214,
                                                  "start_line": 54,
                                                  "start_col": 19
                                                }
                                              },
                                              "index": {
                                                "kind": {
                                                  "String": "email"
                                                },
                                                "span": {
                                                  "start": 1215,
                                                  "end": 1222,
                                                  "start_line": 54,
                                                  "start_col": 24
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1210,
                                            "end": 1224,
                                            "start_line": 54,
                                            "start_col": 19
                                          }
                                        },
                                        "right": {
                                          "kind": "Null",
                                          "span": {
                                            "start": 1227,
                                            "end": 1231,
                                            "start_line": 54,
                                            "start_col": 36
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1210,
                                      "end": 1231,
                                      "start_line": 54,
                                      "start_col": 19
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 1203,
                                    "end": 1231,
                                    "start_line": 54,
                                    "start_col": 12
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 1116,
                            "end": 1242,
                            "start_line": 51,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 1109,
                        "end": 1248,
                        "start_line": 51,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1050,
                "end": 1255,
                "start_line": 49,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "find",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "id",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1276,
                              "end": 1279,
                              "start_line": 58,
                              "start_col": 25
                            }
                          }
                        },
                        "span": {
                          "start": 1276,
                          "end": 1279,
                          "start_line": 58,
                          "start_col": 25
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 1276,
                        "end": 1283,
                        "start_line": 58,
                        "start_col": 25
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "User"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1287,
                              "end": 1296,
                              "start_line": 58,
                              "start_col": 36
                            }
                          }
                        },
                        "span": {
                          "start": 1287,
                          "end": 1296,
                          "start_line": 58,
                          "start_col": 36
                        }
                      }
                    },
                    "span": {
                      "start": 1286,
                      "end": 1296,
                      "start_line": 58,
                      "start_col": 35
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "UnaryPostfix": {
                              "operand": {
                                "kind": {
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Identifier": "self"
                                      },
                                      "span": {
                                        "start": 1306,
                                        "end": 1310,
                                        "start_line": 60,
                                        "start_col": 8
                                      }
                                    },
                                    "member": "queryCount"
                                  }
                                },
                                "span": {
                                  "start": 1306,
                                  "end": 1323,
                                  "start_line": 60,
                                  "start_col": 8
                                }
                              },
                              "op": "PostIncrement"
                            }
                          },
                          "span": {
                            "start": 1306,
                            "end": 1325,
                            "start_line": 60,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1306,
                        "end": 1335,
                        "start_line": 60,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "rows"
                                },
                                "span": {
                                  "start": 1335,
                                  "end": 1340,
                                  "start_line": 61,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 1343,
                                              "end": 1348,
                                              "start_line": 61,
                                              "start_col": 16
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "db"
                                            },
                                            "span": {
                                              "start": 1350,
                                              "end": 1352,
                                              "start_line": 61,
                                              "start_col": 23
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1343,
                                        "end": 1352,
                                        "start_line": 61,
                                        "start_col": 16
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "query"
                                      },
                                      "span": {
                                        "start": 1354,
                                        "end": 1359,
                                        "start_line": 61,
                                        "start_col": 27
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "String": "SELECT * FROM users WHERE id = ?"
                                          },
                                          "span": {
                                            "start": 1360,
                                            "end": 1394,
                                            "start_line": 61,
                                            "start_col": 33
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 1360,
                                          "end": 1394,
                                          "start_line": 61,
                                          "start_col": 33
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 1343,
                                  "end": 1395,
                                  "start_line": 61,
                                  "start_col": 16
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1335,
                            "end": 1395,
                            "start_line": 61,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1335,
                        "end": 1405,
                        "start_line": 61,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Ternary": {
                              "condition": {
                                "kind": {
                                  "Isset": [
                                    {
                                      "kind": {
                                        "ArrayAccess": {
                                          "array": {
                                            "kind": {
                                              "Variable": "rows"
                                            },
                                            "span": {
                                              "start": 1418,
                                              "end": 1423,
                                              "start_line": 62,
                                              "start_col": 21
                                            }
                                          },
                                          "index": {
                                            "kind": {
                                              "Int": 0
                                            },
                                            "span": {
                                              "start": 1424,
                                              "end": 1425,
                                              "start_line": 62,
                                              "start_col": 27
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1418,
                                        "end": 1426,
                                        "start_line": 62,
                                        "start_col": 21
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 1412,
                                  "end": 1427,
                                  "start_line": 62,
                                  "start_col": 15
                                }
                              },
                              "then_expr": {
                                "kind": {
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 1430,
                                        "end": 1435,
                                        "start_line": 62,
                                        "start_col": 33
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "hydrate"
                                      },
                                      "span": {
                                        "start": 1437,
                                        "end": 1444,
                                        "start_line": 62,
                                        "start_col": 40
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "ArrayAccess": {
                                              "array": {
                                                "kind": {
                                                  "Variable": "rows"
                                                },
                                                "span": {
                                                  "start": 1445,
                                                  "end": 1450,
                                                  "start_line": 62,
                                                  "start_col": 48
                                                }
                                              },
                                              "index": {
                                                "kind": {
                                                  "Int": 0
                                                },
                                                "span": {
                                                  "start": 1451,
                                                  "end": 1452,
                                                  "start_line": 62,
                                                  "start_col": 54
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1445,
                                            "end": 1453,
                                            "start_line": 62,
                                            "start_col": 48
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 1445,
                                          "end": 1453,
                                          "start_line": 62,
                                          "start_col": 48
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 1430,
                                  "end": 1455,
                                  "start_line": 62,
                                  "start_col": 33
                                }
                              },
                              "else_expr": {
                                "kind": "Null",
                                "span": {
                                  "start": 1457,
                                  "end": 1461,
                                  "start_line": 62,
                                  "start_col": 60
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1412,
                            "end": 1461,
                            "start_line": 62,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 1405,
                        "end": 1467,
                        "start_line": 62,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1255,
                "end": 1474,
                "start_line": 58,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "findAll",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 1501,
                          "end": 1506,
                          "start_line": 65,
                          "start_col": 31
                        }
                      }
                    },
                    "span": {
                      "start": 1501,
                      "end": 1506,
                      "start_line": 65,
                      "start_col": 31
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "UnaryPostfix": {
                              "operand": {
                                "kind": {
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Identifier": "self"
                                      },
                                      "span": {
                                        "start": 1521,
                                        "end": 1525,
                                        "start_line": 67,
                                        "start_col": 8
                                      }
                                    },
                                    "member": "queryCount"
                                  }
                                },
                                "span": {
                                  "start": 1521,
                                  "end": 1538,
                                  "start_line": 67,
                                  "start_col": 8
                                }
                              },
                              "op": "PostIncrement"
                            }
                          },
                          "span": {
                            "start": 1521,
                            "end": 1540,
                            "start_line": 67,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1521,
                        "end": 1550,
                        "start_line": 67,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "rows"
                                },
                                "span": {
                                  "start": 1550,
                                  "end": 1555,
                                  "start_line": 68,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 1558,
                                              "end": 1563,
                                              "start_line": 68,
                                              "start_col": 16
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "db"
                                            },
                                            "span": {
                                              "start": 1565,
                                              "end": 1567,
                                              "start_line": 68,
                                              "start_col": 23
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1558,
                                        "end": 1567,
                                        "start_line": 68,
                                        "start_col": 16
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "query"
                                      },
                                      "span": {
                                        "start": 1569,
                                        "end": 1574,
                                        "start_line": 68,
                                        "start_col": 27
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Binary": {
                                              "left": {
                                                "kind": {
                                                  "String": "SELECT * FROM "
                                                },
                                                "span": {
                                                  "start": 1575,
                                                  "end": 1591,
                                                  "start_line": 68,
                                                  "start_col": 33
                                                }
                                              },
                                              "op": "Concat",
                                              "right": {
                                                "kind": {
                                                  "MethodCall": {
                                                    "object": {
                                                      "kind": {
                                                        "Variable": "this"
                                                      },
                                                      "span": {
                                                        "start": 1594,
                                                        "end": 1599,
                                                        "start_line": 68,
                                                        "start_col": 52
                                                      }
                                                    },
                                                    "method": {
                                                      "kind": {
                                                        "Identifier": "tableName"
                                                      },
                                                      "span": {
                                                        "start": 1601,
                                                        "end": 1610,
                                                        "start_line": 68,
                                                        "start_col": 59
                                                      }
                                                    },
                                                    "args": []
                                                  }
                                                },
                                                "span": {
                                                  "start": 1594,
                                                  "end": 1612,
                                                  "start_line": 68,
                                                  "start_col": 52
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1575,
                                            "end": 1612,
                                            "start_line": 68,
                                            "start_col": 33
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 1575,
                                          "end": 1612,
                                          "start_line": 68,
                                          "start_col": 33
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 1558,
                                  "end": 1613,
                                  "start_line": 68,
                                  "start_col": 16
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1550,
                            "end": 1613,
                            "start_line": 68,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1550,
                        "end": 1623,
                        "start_line": 68,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Identifier": "array_map"
                                },
                                "span": {
                                  "start": 1630,
                                  "end": 1639,
                                  "start_line": 69,
                                  "start_col": 15
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "ArrowFunction": {
                                        "is_static": false,
                                        "by_ref": false,
                                        "params": [
                                          {
                                            "name": "row",
                                            "type_hint": {
                                              "kind": {
                                                "Named": {
                                                  "parts": [
                                                    "array"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 1643,
                                                    "end": 1648,
                                                    "start_line": 69,
                                                    "start_col": 28
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1643,
                                                "end": 1648,
                                                "start_line": 69,
                                                "start_col": 28
                                              }
                                            },
                                            "default": null,
                                            "by_ref": false,
                                            "variadic": false,
                                            "is_readonly": false,
                                            "is_final": false,
                                            "visibility": null,
                                            "set_visibility": null,
                                            "attributes": [],
                                            "span": {
                                              "start": 1643,
                                              "end": 1653,
                                              "start_line": 69,
                                              "start_col": 28
                                            }
                                          }
                                        ],
                                        "return_type": null,
                                        "body": {
                                          "kind": {
                                            "MethodCall": {
                                              "object": {
                                                "kind": {
                                                  "Variable": "this"
                                                },
                                                "span": {
                                                  "start": 1658,
                                                  "end": 1663,
                                                  "start_line": 69,
                                                  "start_col": 43
                                                }
                                              },
                                              "method": {
                                                "kind": {
                                                  "Identifier": "hydrate"
                                                },
                                                "span": {
                                                  "start": 1665,
                                                  "end": 1672,
                                                  "start_line": 69,
                                                  "start_col": 50
                                                }
                                              },
                                              "args": [
                                                {
                                                  "name": null,
                                                  "value": {
                                                    "kind": {
                                                      "Variable": "row"
                                                    },
                                                    "span": {
                                                      "start": 1673,
                                                      "end": 1677,
                                                      "start_line": 69,
                                                      "start_col": 58
                                                    }
                                                  },
                                                  "unpack": false,
                                                  "by_ref": false,
                                                  "span": {
                                                    "start": 1673,
                                                    "end": 1677,
                                                    "start_line": 69,
                                                    "start_col": 58
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 1658,
                                            "end": 1678,
                                            "start_line": 69,
                                            "start_col": 43
                                          }
                                        },
                                        "attributes": []
                                      }
                                    },
                                    "span": {
                                      "start": 1640,
                                      "end": 1678,
                                      "start_line": 69,
                                      "start_col": 25
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 1640,
                                    "end": 1678,
                                    "start_line": 69,
                                    "start_col": 25
                                  }
                                },
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "Variable": "rows"
                                    },
                                    "span": {
                                      "start": 1680,
                                      "end": 1685,
                                      "start_line": 69,
                                      "start_col": 65
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 1680,
                                    "end": 1685,
                                    "start_line": 69,
                                    "start_col": 65
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 1630,
                            "end": 1686,
                            "start_line": 69,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 1623,
                        "end": 1692,
                        "start_line": 69,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1474,
                "end": 1699,
                "start_line": 65,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "findByEmail",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "email",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1727,
                              "end": 1733,
                              "start_line": 72,
                              "start_col": 32
                            }
                          }
                        },
                        "span": {
                          "start": 1727,
                          "end": 1733,
                          "start_line": 72,
                          "start_col": 32
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 1727,
                        "end": 1740,
                        "start_line": 72,
                        "start_col": 32
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "User"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1744,
                              "end": 1753,
                              "start_line": 72,
                              "start_col": 49
                            }
                          }
                        },
                        "span": {
                          "start": 1744,
                          "end": 1753,
                          "start_line": 72,
                          "start_col": 49
                        }
                      }
                    },
                    "span": {
                      "start": 1743,
                      "end": 1753,
                      "start_line": 72,
                      "start_col": 48
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "sanitized"
                                },
                                "span": {
                                  "start": 1763,
                                  "end": 1773,
                                  "start_line": 74,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Identifier": "sanitize"
                                      },
                                      "span": {
                                        "start": 1776,
                                        "end": 1784,
                                        "start_line": 74,
                                        "start_col": 21
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Variable": "email"
                                          },
                                          "span": {
                                            "start": 1785,
                                            "end": 1791,
                                            "start_line": 74,
                                            "start_col": 30
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 1785,
                                          "end": 1791,
                                          "start_line": 74,
                                          "start_col": 30
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 1776,
                                  "end": 1792,
                                  "start_line": 74,
                                  "start_col": 21
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1763,
                            "end": 1792,
                            "start_line": 74,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1763,
                        "end": 1802,
                        "start_line": 74,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "users"
                                },
                                "span": {
                                  "start": 1802,
                                  "end": 1808,
                                  "start_line": 75,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 1811,
                                        "end": 1816,
                                        "start_line": 75,
                                        "start_col": 17
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "findAll"
                                      },
                                      "span": {
                                        "start": 1818,
                                        "end": 1825,
                                        "start_line": 75,
                                        "start_col": 24
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 1811,
                                  "end": 1827,
                                  "start_line": 75,
                                  "start_col": 17
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1802,
                            "end": 1827,
                            "start_line": 75,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1802,
                        "end": 1837,
                        "start_line": 75,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "filtered"
                                },
                                "span": {
                                  "start": 1837,
                                  "end": 1846,
                                  "start_line": 76,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Identifier": "array_filter"
                                      },
                                      "span": {
                                        "start": 1849,
                                        "end": 1861,
                                        "start_line": 76,
                                        "start_col": 20
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Variable": "users"
                                          },
                                          "span": {
                                            "start": 1875,
                                            "end": 1881,
                                            "start_line": 77,
                                            "start_col": 12
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 1875,
                                          "end": 1881,
                                          "start_line": 77,
                                          "start_col": 12
                                        }
                                      },
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Closure": {
                                              "is_static": false,
                                              "by_ref": false,
                                              "params": [
                                                {
                                                  "name": "u",
                                                  "type_hint": {
                                                    "kind": {
                                                      "Named": {
                                                        "parts": [
                                                          "User"
                                                        ],
                                                        "kind": "Unqualified",
                                                        "span": {
                                                          "start": 1904,
                                                          "end": 1909,
                                                          "start_line": 78,
                                                          "start_col": 21
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 1904,
                                                      "end": 1909,
                                                      "start_line": 78,
                                                      "start_col": 21
                                                    }
                                                  },
                                                  "default": null,
                                                  "by_ref": false,
                                                  "variadic": false,
                                                  "is_readonly": false,
                                                  "is_final": false,
                                                  "visibility": null,
                                                  "set_visibility": null,
                                                  "attributes": [],
                                                  "span": {
                                                    "start": 1904,
                                                    "end": 1911,
                                                    "start_line": 78,
                                                    "start_col": 21
                                                  }
                                                }
                                              ],
                                              "use_vars": [
                                                {
                                                  "name": "sanitized",
                                                  "by_ref": false,
                                                  "span": {
                                                    "start": 1918,
                                                    "end": 1928,
                                                    "start_line": 78,
                                                    "start_col": 35
                                                  }
                                                }
                                              ],
                                              "return_type": {
                                                "kind": {
                                                  "Named": {
                                                    "parts": [
                                                      "bool"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 1931,
                                                      "end": 1935,
                                                      "start_line": 78,
                                                      "start_col": 48
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1931,
                                                  "end": 1935,
                                                  "start_line": 78,
                                                  "start_col": 48
                                                }
                                              },
                                              "body": [
                                                {
                                                  "kind": {
                                                    "Return": {
                                                      "kind": {
                                                        "Binary": {
                                                          "left": {
                                                            "kind": {
                                                              "PropertyAccess": {
                                                                "object": {
                                                                  "kind": {
                                                                    "Variable": "u"
                                                                  },
                                                                  "span": {
                                                                    "start": 1961,
                                                                    "end": 1963,
                                                                    "start_line": 79,
                                                                    "start_col": 23
                                                                  }
                                                                },
                                                                "property": {
                                                                  "kind": {
                                                                    "Identifier": "email"
                                                                  },
                                                                  "span": {
                                                                    "start": 1965,
                                                                    "end": 1970,
                                                                    "start_line": 79,
                                                                    "start_col": 27
                                                                  }
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 1961,
                                                              "end": 1970,
                                                              "start_line": 79,
                                                              "start_col": 23
                                                            }
                                                          },
                                                          "op": "Identical",
                                                          "right": {
                                                            "kind": {
                                                              "Variable": "sanitized"
                                                            },
                                                            "span": {
                                                              "start": 1975,
                                                              "end": 1985,
                                                              "start_line": 79,
                                                              "start_col": 37
                                                            }
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 1961,
                                                        "end": 1985,
                                                        "start_line": 79,
                                                        "start_col": 23
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1954,
                                                    "end": 1999,
                                                    "start_line": 79,
                                                    "start_col": 16
                                                  }
                                                }
                                              ],
                                              "attributes": []
                                            }
                                          },
                                          "span": {
                                            "start": 1895,
                                            "end": 2000,
                                            "start_line": 78,
                                            "start_col": 12
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 1895,
                                          "end": 2000,
                                          "start_line": 78,
                                          "start_col": 12
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 1849,
                                  "end": 2010,
                                  "start_line": 76,
                                  "start_col": 20
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1837,
                            "end": 2010,
                            "start_line": 76,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1837,
                        "end": 2020,
                        "start_line": 76,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "NullCoalesce": {
                              "left": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "filtered"
                                      },
                                      "span": {
                                        "start": 2027,
                                        "end": 2036,
                                        "start_line": 82,
                                        "start_col": 15
                                      }
                                    },
                                    "index": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 2037,
                                        "end": 2038,
                                        "start_line": 82,
                                        "start_col": 25
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2027,
                                  "end": 2040,
                                  "start_line": 82,
                                  "start_col": 15
                                }
                              },
                              "right": {
                                "kind": "Null",
                                "span": {
                                  "start": 2043,
                                  "end": 2047,
                                  "start_line": 82,
                                  "start_col": 31
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 2027,
                            "end": 2047,
                            "start_line": 82,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 2020,
                        "end": 2053,
                        "start_line": 82,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1699,
                "end": 2060,
                "start_line": 72,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "save",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "user",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "User"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 2081,
                              "end": 2086,
                              "start_line": 85,
                              "start_col": 25
                            }
                          }
                        },
                        "span": {
                          "start": 2081,
                          "end": 2086,
                          "start_line": 85,
                          "start_col": 25
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 2081,
                        "end": 2091,
                        "start_line": 85,
                        "start_col": 25
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 2094,
                          "end": 2098,
                          "start_line": 85,
                          "start_col": 38
                        }
                      }
                    },
                    "span": {
                      "start": 2094,
                      "end": 2098,
                      "start_line": 85,
                      "start_col": 38
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "TryCatch": {
                          "body": [
                            {
                              "kind": {
                                "Expression": {
                                  "kind": {
                                    "MethodCall": {
                                      "object": {
                                        "kind": {
                                          "PropertyAccess": {
                                            "object": {
                                              "kind": {
                                                "Variable": "this"
                                              },
                                              "span": {
                                                "start": 2131,
                                                "end": 2136,
                                                "start_line": 88,
                                                "start_col": 12
                                              }
                                            },
                                            "property": {
                                              "kind": {
                                                "Identifier": "db"
                                              },
                                              "span": {
                                                "start": 2138,
                                                "end": 2140,
                                                "start_line": 88,
                                                "start_col": 19
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 2131,
                                          "end": 2140,
                                          "start_line": 88,
                                          "start_col": 12
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "query"
                                        },
                                        "span": {
                                          "start": 2142,
                                          "end": 2147,
                                          "start_line": 88,
                                          "start_col": 23
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "value": {
                                            "kind": {
                                              "String": "INSERT INTO users VALUES (?)"
                                            },
                                            "span": {
                                              "start": 2148,
                                              "end": 2178,
                                              "start_line": 88,
                                              "start_col": 29
                                            }
                                          },
                                          "unpack": false,
                                          "by_ref": false,
                                          "span": {
                                            "start": 2148,
                                            "end": 2178,
                                            "start_line": 88,
                                            "start_col": 29
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 2131,
                                    "end": 2179,
                                    "start_line": 88,
                                    "start_col": 12
                                  }
                                }
                              },
                              "span": {
                                "start": 2131,
                                "end": 2193,
                                "start_line": 88,
                                "start_col": 12
                              }
                            },
                            {
                              "kind": {
                                "Expression": {
                                  "kind": {
                                    "MethodCall": {
                                      "object": {
                                        "kind": {
                                          "Variable": "this"
                                        },
                                        "span": {
                                          "start": 2193,
                                          "end": 2198,
                                          "start_line": 89,
                                          "start_col": 12
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "log"
                                        },
                                        "span": {
                                          "start": 2200,
                                          "end": 2203,
                                          "start_line": 89,
                                          "start_col": 19
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "value": {
                                            "kind": {
                                              "Binary": {
                                                "left": {
                                                  "kind": {
                                                    "String": "User saved: "
                                                  },
                                                  "span": {
                                                    "start": 2204,
                                                    "end": 2218,
                                                    "start_line": 89,
                                                    "start_col": 23
                                                  }
                                                },
                                                "op": "Concat",
                                                "right": {
                                                  "kind": {
                                                    "PropertyAccess": {
                                                      "object": {
                                                        "kind": {
                                                          "Variable": "user"
                                                        },
                                                        "span": {
                                                          "start": 2221,
                                                          "end": 2226,
                                                          "start_line": 89,
                                                          "start_col": 40
                                                        }
                                                      },
                                                      "property": {
                                                        "kind": {
                                                          "Identifier": "name"
                                                        },
                                                        "span": {
                                                          "start": 2228,
                                                          "end": 2232,
                                                          "start_line": 89,
                                                          "start_col": 47
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 2221,
                                                    "end": 2232,
                                                    "start_line": 89,
                                                    "start_col": 40
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 2204,
                                              "end": 2232,
                                              "start_line": 89,
                                              "start_col": 23
                                            }
                                          },
                                          "unpack": false,
                                          "by_ref": false,
                                          "span": {
                                            "start": 2204,
                                            "end": 2232,
                                            "start_line": 89,
                                            "start_col": 23
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 2193,
                                    "end": 2233,
                                    "start_line": 89,
                                    "start_col": 12
                                  }
                                }
                              },
                              "span": {
                                "start": 2193,
                                "end": 2243,
                                "start_line": 89,
                                "start_col": 12
                              }
                            }
                          ],
                          "catches": [
                            {
                              "types": [
                                {
                                  "parts": [
                                    "PDOException"
                                  ],
                                  "kind": "FullyQualified",
                                  "span": {
                                    "start": 2252,
                                    "end": 2266,
                                    "start_line": 90,
                                    "start_col": 17
                                  }
                                }
                              ],
                              "var": "e",
                              "body": [
                                {
                                  "kind": {
                                    "Expression": {
                                      "kind": {
                                        "MethodCall": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 2284,
                                              "end": 2289,
                                              "start_line": 91,
                                              "start_col": 12
                                            }
                                          },
                                          "method": {
                                            "kind": {
                                              "Identifier": "log"
                                            },
                                            "span": {
                                              "start": 2291,
                                              "end": 2294,
                                              "start_line": 91,
                                              "start_col": 19
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "Binary": {
                                                    "left": {
                                                      "kind": {
                                                        "String": "Save failed: "
                                                      },
                                                      "span": {
                                                        "start": 2295,
                                                        "end": 2310,
                                                        "start_line": 91,
                                                        "start_col": 23
                                                      }
                                                    },
                                                    "op": "Concat",
                                                    "right": {
                                                      "kind": {
                                                        "MethodCall": {
                                                          "object": {
                                                            "kind": {
                                                              "Variable": "e"
                                                            },
                                                            "span": {
                                                              "start": 2313,
                                                              "end": 2315,
                                                              "start_line": 91,
                                                              "start_col": 41
                                                            }
                                                          },
                                                          "method": {
                                                            "kind": {
                                                              "Identifier": "getMessage"
                                                            },
                                                            "span": {
                                                              "start": 2317,
                                                              "end": 2327,
                                                              "start_line": 91,
                                                              "start_col": 45
                                                            }
                                                          },
                                                          "args": []
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 2313,
                                                        "end": 2329,
                                                        "start_line": 91,
                                                        "start_col": 41
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 2295,
                                                  "end": 2329,
                                                  "start_line": 91,
                                                  "start_col": 23
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 2295,
                                                "end": 2329,
                                                "start_line": 91,
                                                "start_col": 23
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 2284,
                                        "end": 2330,
                                        "start_line": 91,
                                        "start_col": 12
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 2284,
                                    "end": 2344,
                                    "start_line": 91,
                                    "start_col": 12
                                  }
                                },
                                {
                                  "kind": {
                                    "Throw": {
                                      "kind": {
                                        "Variable": "e"
                                      },
                                      "span": {
                                        "start": 2350,
                                        "end": 2352,
                                        "start_line": 92,
                                        "start_col": 18
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 2344,
                                    "end": 2362,
                                    "start_line": 92,
                                    "start_col": 12
                                  }
                                }
                              ],
                              "span": {
                                "start": 2251,
                                "end": 2368,
                                "start_line": 90,
                                "start_col": 16
                              }
                            }
                          ],
                          "finally": null
                        }
                      },
                      "span": {
                        "start": 2113,
                        "end": 2368,
                        "start_line": 87,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 2060,
                "end": 2375,
                "start_line": 85,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "delete",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "id",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 2398,
                              "end": 2401,
                              "start_line": 96,
                              "start_col": 27
                            }
                          }
                        },
                        "span": {
                          "start": 2398,
                          "end": 2401,
                          "start_line": 96,
                          "start_col": 27
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 2398,
                        "end": 2405,
                        "start_line": 96,
                        "start_col": 27
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 2408,
                          "end": 2412,
                          "start_line": 96,
                          "start_col": 37
                        }
                      }
                    },
                    "span": {
                      "start": 2408,
                      "end": 2412,
                      "start_line": 96,
                      "start_col": 37
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "user"
                                },
                                "span": {
                                  "start": 2427,
                                  "end": 2432,
                                  "start_line": 98,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "NullCoalesce": {
                                    "left": {
                                      "kind": {
                                        "MethodCall": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 2435,
                                              "end": 2440,
                                              "start_line": 98,
                                              "start_col": 16
                                            }
                                          },
                                          "method": {
                                            "kind": {
                                              "Identifier": "find"
                                            },
                                            "span": {
                                              "start": 2442,
                                              "end": 2446,
                                              "start_line": 98,
                                              "start_col": 23
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "Variable": "id"
                                                },
                                                "span": {
                                                  "start": 2447,
                                                  "end": 2450,
                                                  "start_line": 98,
                                                  "start_col": 28
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 2447,
                                                "end": 2450,
                                                "start_line": 98,
                                                "start_col": 28
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 2435,
                                        "end": 2452,
                                        "start_line": 98,
                                        "start_col": 16
                                      }
                                    },
                                    "right": {
                                      "kind": {
                                        "ThrowExpr": {
                                          "kind": {
                                            "New": {
                                              "class": {
                                                "kind": {
                                                  "Identifier": "\\RuntimeException"
                                                },
                                                "span": {
                                                  "start": 2465,
                                                  "end": 2482,
                                                  "start_line": 98,
                                                  "start_col": 46
                                                }
                                              },
                                              "args": [
                                                {
                                                  "name": null,
                                                  "value": {
                                                    "kind": {
                                                      "String": "User not found"
                                                    },
                                                    "span": {
                                                      "start": 2483,
                                                      "end": 2499,
                                                      "start_line": 98,
                                                      "start_col": 64
                                                    }
                                                  },
                                                  "unpack": false,
                                                  "by_ref": false,
                                                  "span": {
                                                    "start": 2483,
                                                    "end": 2499,
                                                    "start_line": 98,
                                                    "start_col": 64
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 2461,
                                            "end": 2500,
                                            "start_line": 98,
                                            "start_col": 42
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 2455,
                                        "end": 2500,
                                        "start_line": 98,
                                        "start_col": 36
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2435,
                                  "end": 2500,
                                  "start_line": 98,
                                  "start_col": 16
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 2427,
                            "end": 2500,
                            "start_line": 98,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 2427,
                        "end": 2510,
                        "start_line": 98,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 2510,
                                        "end": 2515,
                                        "start_line": 99,
                                        "start_col": 8
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "db"
                                      },
                                      "span": {
                                        "start": 2517,
                                        "end": 2519,
                                        "start_line": 99,
                                        "start_col": 15
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2510,
                                  "end": 2519,
                                  "start_line": 99,
                                  "start_col": 8
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "query"
                                },
                                "span": {
                                  "start": 2521,
                                  "end": 2526,
                                  "start_line": 99,
                                  "start_col": 19
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "String": "DELETE FROM users WHERE id = ?"
                                    },
                                    "span": {
                                      "start": 2527,
                                      "end": 2559,
                                      "start_line": 99,
                                      "start_col": 25
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 2527,
                                    "end": 2559,
                                    "start_line": 99,
                                    "start_col": 25
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 2510,
                            "end": 2560,
                            "start_line": 99,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 2510,
                        "end": 2570,
                        "start_line": 99,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 2570,
                                  "end": 2575,
                                  "start_line": 100,
                                  "start_col": 8
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "log"
                                },
                                "span": {
                                  "start": 2577,
                                  "end": 2580,
                                  "start_line": 100,
                                  "start_col": 15
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "String": "User deleted: "
                                          },
                                          "span": {
                                            "start": 2581,
                                            "end": 2597,
                                            "start_line": 100,
                                            "start_col": 19
                                          }
                                        },
                                        "op": "Concat",
                                        "right": {
                                          "kind": {
                                            "PropertyAccess": {
                                              "object": {
                                                "kind": {
                                                  "Variable": "user"
                                                },
                                                "span": {
                                                  "start": 2600,
                                                  "end": 2605,
                                                  "start_line": 100,
                                                  "start_col": 38
                                                }
                                              },
                                              "property": {
                                                "kind": {
                                                  "Identifier": "name"
                                                },
                                                "span": {
                                                  "start": 2607,
                                                  "end": 2611,
                                                  "start_line": 100,
                                                  "start_col": 45
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 2600,
                                            "end": 2611,
                                            "start_line": 100,
                                            "start_col": 38
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 2581,
                                      "end": 2611,
                                      "start_line": 100,
                                      "start_col": 19
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 2581,
                                    "end": 2611,
                                    "start_line": 100,
                                    "start_col": 19
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 2570,
                            "end": 2612,
                            "start_line": 100,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 2570,
                        "end": 2618,
                        "start_line": 100,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 2375,
                "end": 2625,
                "start_line": 96,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "getQueryCount",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 2665,
                          "end": 2668,
                          "start_line": 103,
                          "start_col": 44
                        }
                      }
                    },
                    "span": {
                      "start": 2665,
                      "end": 2668,
                      "start_line": 103,
                      "start_col": 44
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "StaticPropertyAccess": {
                              "class": {
                                "kind": {
                                  "Identifier": "self"
                                },
                                "span": {
                                  "start": 2690,
                                  "end": 2694,
                                  "start_line": 105,
                                  "start_col": 15
                                }
                              },
                              "member": "queryCount"
                            }
                          },
                          "span": {
                            "start": 2690,
                            "end": 2707,
                            "start_line": 105,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 2683,
                        "end": 2713,
                        "start_line": 105,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 2625,
                "end": 2715,
                "start_line": 103,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 782,
        "end": 2716,
        "start_line": 37,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 2716,
    "start_line": 1,
    "start_col": 0
  }
}
