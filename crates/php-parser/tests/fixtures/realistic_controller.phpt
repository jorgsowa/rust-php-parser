===source===
<?php
namespace App\Controllers;

use App\Models\User;
use App\Services\AuthService as Auth;

class UserController extends BaseController implements JsonResponder
{
    private readonly AuthService $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function show(int $id): array
    {
        try {
            $user = User::find($id) ?? throw new NotFoundException('User not found');
            $role = match ($user->role) {
                'admin' => 'Administrator',
                'editor' => 'Editor',
                default => 'User',
            };
            $data = [
                'name' => $user->name,
                'email' => $user?->email,
                'role' => $role,
            ];
            return $data;
        } catch (NotFoundException $e) {
            return ['error' => $e->getMessage()];
        } finally {
            $this->auth->logAccess($id);
        }
    }

    public function list(): array
    {
        $users = User::all();
        $names = array_map(fn($u) => $u->getName(), $users);
        $filtered = array_filter($names, function($name) use ($users) {
            return strlen($name) > 0;
        });
        return $filtered;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "App",
              "Controllers"
            ],
            "kind": "Qualified",
            "span": {
              "start": 16,
              "end": 31,
              "start_line": 2,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 34,
        "start_line": 2,
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
                  "start": 38,
                  "end": 53,
                  "start_line": 4,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 38,
                "end": 53,
                "start_line": 4,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 34,
        "end": 55,
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
                  "Services",
                  "AuthService"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 59,
                  "end": 84,
                  "start_line": 5,
                  "start_col": 4
                }
              },
              "alias": "Auth",
              "span": {
                "start": 59,
                "end": 91,
                "start_line": 5,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 55,
        "end": 94,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "UserController",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "BaseController"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 123,
              "end": 138,
              "start_line": 7,
              "start_col": 29
            }
          },
          "implements": [
            {
              "parts": [
                "JsonResponder"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 149,
                "end": 163,
                "start_line": 7,
                "start_col": 55
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": "auth",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "AuthService"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 186,
                          "end": 198,
                          "start_line": 9,
                          "start_col": 21
                        }
                      }
                    },
                    "span": {
                      "start": 186,
                      "end": 198,
                      "start_line": 9,
                      "start_col": 21
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 169,
                "end": 203,
                "start_line": 9,
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
                      "name": "auth",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "AuthService"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 238,
                              "end": 250,
                              "start_line": 11,
                              "start_col": 32
                            }
                          }
                        },
                        "span": {
                          "start": 238,
                          "end": 250,
                          "start_line": 11,
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
                        "start": 238,
                        "end": 255,
                        "start_line": 11,
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
                                        "start": 271,
                                        "end": 276,
                                        "start_line": 13,
                                        "start_col": 8
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "auth"
                                      },
                                      "span": {
                                        "start": 278,
                                        "end": 282,
                                        "start_line": 13,
                                        "start_col": 15
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 271,
                                  "end": 282,
                                  "start_line": 13,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "auth"
                                },
                                "span": {
                                  "start": 285,
                                  "end": 290,
                                  "start_line": 13,
                                  "start_col": 22
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 271,
                            "end": 290,
                            "start_line": 13,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 271,
                        "end": 296,
                        "start_line": 13,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 210,
                "end": 303,
                "start_line": 11,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "show",
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
                              "start": 324,
                              "end": 327,
                              "start_line": 16,
                              "start_col": 25
                            }
                          }
                        },
                        "span": {
                          "start": 324,
                          "end": 327,
                          "start_line": 16,
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
                        "start": 324,
                        "end": 331,
                        "start_line": 16,
                        "start_col": 25
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 334,
                          "end": 339,
                          "start_line": 16,
                          "start_col": 35
                        }
                      }
                    },
                    "span": {
                      "start": 334,
                      "end": 339,
                      "start_line": 16,
                      "start_col": 35
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
                                    "Assign": {
                                      "target": {
                                        "kind": {
                                          "Variable": "user"
                                        },
                                        "span": {
                                          "start": 372,
                                          "end": 377,
                                          "start_line": 19,
                                          "start_col": 12
                                        }
                                      },
                                      "op": "Assign",
                                      "value": {
                                        "kind": {
                                          "NullCoalesce": {
                                            "left": {
                                              "kind": {
                                                "StaticMethodCall": {
                                                  "class": {
                                                    "kind": {
                                                      "Identifier": "User"
                                                    },
                                                    "span": {
                                                      "start": 380,
                                                      "end": 384,
                                                      "start_line": 19,
                                                      "start_col": 20
                                                    }
                                                  },
                                                  "method": "find",
                                                  "args": [
                                                    {
                                                      "name": null,
                                                      "value": {
                                                        "kind": {
                                                          "Variable": "id"
                                                        },
                                                        "span": {
                                                          "start": 391,
                                                          "end": 394,
                                                          "start_line": 19,
                                                          "start_col": 31
                                                        }
                                                      },
                                                      "unpack": false,
                                                      "by_ref": false,
                                                      "span": {
                                                        "start": 391,
                                                        "end": 394,
                                                        "start_line": 19,
                                                        "start_col": 31
                                                      }
                                                    }
                                                  ]
                                                }
                                              },
                                              "span": {
                                                "start": 380,
                                                "end": 396,
                                                "start_line": 19,
                                                "start_col": 20
                                              }
                                            },
                                            "right": {
                                              "kind": {
                                                "ThrowExpr": {
                                                  "kind": {
                                                    "New": {
                                                      "class": {
                                                        "kind": {
                                                          "Identifier": "NotFoundException"
                                                        },
                                                        "span": {
                                                          "start": 409,
                                                          "end": 426,
                                                          "start_line": 19,
                                                          "start_col": 49
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
                                                              "start": 427,
                                                              "end": 443,
                                                              "start_line": 19,
                                                              "start_col": 67
                                                            }
                                                          },
                                                          "unpack": false,
                                                          "by_ref": false,
                                                          "span": {
                                                            "start": 427,
                                                            "end": 443,
                                                            "start_line": 19,
                                                            "start_col": 67
                                                          }
                                                        }
                                                      ]
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 405,
                                                    "end": 444,
                                                    "start_line": 19,
                                                    "start_col": 45
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 399,
                                                "end": 444,
                                                "start_line": 19,
                                                "start_col": 39
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 380,
                                          "end": 444,
                                          "start_line": 19,
                                          "start_col": 20
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 372,
                                    "end": 444,
                                    "start_line": 19,
                                    "start_col": 12
                                  }
                                }
                              },
                              "span": {
                                "start": 372,
                                "end": 458,
                                "start_line": 19,
                                "start_col": 12
                              }
                            },
                            {
                              "kind": {
                                "Expression": {
                                  "kind": {
                                    "Assign": {
                                      "target": {
                                        "kind": {
                                          "Variable": "role"
                                        },
                                        "span": {
                                          "start": 458,
                                          "end": 463,
                                          "start_line": 20,
                                          "start_col": 12
                                        }
                                      },
                                      "op": "Assign",
                                      "value": {
                                        "kind": {
                                          "Match": {
                                            "subject": {
                                              "kind": {
                                                "PropertyAccess": {
                                                  "object": {
                                                    "kind": {
                                                      "Variable": "user"
                                                    },
                                                    "span": {
                                                      "start": 473,
                                                      "end": 478,
                                                      "start_line": 20,
                                                      "start_col": 27
                                                    }
                                                  },
                                                  "property": {
                                                    "kind": {
                                                      "Identifier": "role"
                                                    },
                                                    "span": {
                                                      "start": 480,
                                                      "end": 484,
                                                      "start_line": 20,
                                                      "start_col": 34
                                                    }
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 473,
                                                "end": 484,
                                                "start_line": 20,
                                                "start_col": 27
                                              }
                                            },
                                            "arms": [
                                              {
                                                "conditions": [
                                                  {
                                                    "kind": {
                                                      "String": "admin"
                                                    },
                                                    "span": {
                                                      "start": 504,
                                                      "end": 511,
                                                      "start_line": 21,
                                                      "start_col": 16
                                                    }
                                                  }
                                                ],
                                                "body": {
                                                  "kind": {
                                                    "String": "Administrator"
                                                  },
                                                  "span": {
                                                    "start": 515,
                                                    "end": 530,
                                                    "start_line": 21,
                                                    "start_col": 27
                                                  }
                                                },
                                                "span": {
                                                  "start": 504,
                                                  "end": 530,
                                                  "start_line": 21,
                                                  "start_col": 16
                                                }
                                              },
                                              {
                                                "conditions": [
                                                  {
                                                    "kind": {
                                                      "String": "editor"
                                                    },
                                                    "span": {
                                                      "start": 548,
                                                      "end": 556,
                                                      "start_line": 22,
                                                      "start_col": 16
                                                    }
                                                  }
                                                ],
                                                "body": {
                                                  "kind": {
                                                    "String": "Editor"
                                                  },
                                                  "span": {
                                                    "start": 560,
                                                    "end": 568,
                                                    "start_line": 22,
                                                    "start_col": 28
                                                  }
                                                },
                                                "span": {
                                                  "start": 548,
                                                  "end": 568,
                                                  "start_line": 22,
                                                  "start_col": 16
                                                }
                                              },
                                              {
                                                "conditions": null,
                                                "body": {
                                                  "kind": {
                                                    "String": "User"
                                                  },
                                                  "span": {
                                                    "start": 597,
                                                    "end": 603,
                                                    "start_line": 23,
                                                    "start_col": 27
                                                  }
                                                },
                                                "span": {
                                                  "start": 586,
                                                  "end": 603,
                                                  "start_line": 23,
                                                  "start_col": 16
                                                }
                                              }
                                            ]
                                          }
                                        },
                                        "span": {
                                          "start": 466,
                                          "end": 618,
                                          "start_line": 20,
                                          "start_col": 20
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 458,
                                    "end": 618,
                                    "start_line": 20,
                                    "start_col": 12
                                  }
                                }
                              },
                              "span": {
                                "start": 458,
                                "end": 632,
                                "start_line": 20,
                                "start_col": 12
                              }
                            },
                            {
                              "kind": {
                                "Expression": {
                                  "kind": {
                                    "Assign": {
                                      "target": {
                                        "kind": {
                                          "Variable": "data"
                                        },
                                        "span": {
                                          "start": 632,
                                          "end": 637,
                                          "start_line": 25,
                                          "start_col": 12
                                        }
                                      },
                                      "op": "Assign",
                                      "value": {
                                        "kind": {
                                          "Array": [
                                            {
                                              "key": {
                                                "kind": {
                                                  "String": "name"
                                                },
                                                "span": {
                                                  "start": 658,
                                                  "end": 664,
                                                  "start_line": 26,
                                                  "start_col": 16
                                                }
                                              },
                                              "value": {
                                                "kind": {
                                                  "PropertyAccess": {
                                                    "object": {
                                                      "kind": {
                                                        "Variable": "user"
                                                      },
                                                      "span": {
                                                        "start": 668,
                                                        "end": 673,
                                                        "start_line": 26,
                                                        "start_col": 26
                                                      }
                                                    },
                                                    "property": {
                                                      "kind": {
                                                        "Identifier": "name"
                                                      },
                                                      "span": {
                                                        "start": 675,
                                                        "end": 679,
                                                        "start_line": 26,
                                                        "start_col": 33
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 668,
                                                  "end": 679,
                                                  "start_line": 26,
                                                  "start_col": 26
                                                }
                                              },
                                              "unpack": false,
                                              "span": {
                                                "start": 658,
                                                "end": 679,
                                                "start_line": 26,
                                                "start_col": 16
                                              }
                                            },
                                            {
                                              "key": {
                                                "kind": {
                                                  "String": "email"
                                                },
                                                "span": {
                                                  "start": 697,
                                                  "end": 704,
                                                  "start_line": 27,
                                                  "start_col": 16
                                                }
                                              },
                                              "value": {
                                                "kind": {
                                                  "NullsafePropertyAccess": {
                                                    "object": {
                                                      "kind": {
                                                        "Variable": "user"
                                                      },
                                                      "span": {
                                                        "start": 708,
                                                        "end": 713,
                                                        "start_line": 27,
                                                        "start_col": 27
                                                      }
                                                    },
                                                    "property": {
                                                      "kind": {
                                                        "Identifier": "email"
                                                      },
                                                      "span": {
                                                        "start": 716,
                                                        "end": 721,
                                                        "start_line": 27,
                                                        "start_col": 35
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 708,
                                                  "end": 721,
                                                  "start_line": 27,
                                                  "start_col": 27
                                                }
                                              },
                                              "unpack": false,
                                              "span": {
                                                "start": 697,
                                                "end": 721,
                                                "start_line": 27,
                                                "start_col": 16
                                              }
                                            },
                                            {
                                              "key": {
                                                "kind": {
                                                  "String": "role"
                                                },
                                                "span": {
                                                  "start": 739,
                                                  "end": 745,
                                                  "start_line": 28,
                                                  "start_col": 16
                                                }
                                              },
                                              "value": {
                                                "kind": {
                                                  "Variable": "role"
                                                },
                                                "span": {
                                                  "start": 749,
                                                  "end": 754,
                                                  "start_line": 28,
                                                  "start_col": 26
                                                }
                                              },
                                              "unpack": false,
                                              "span": {
                                                "start": 739,
                                                "end": 754,
                                                "start_line": 28,
                                                "start_col": 16
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 640,
                                          "end": 769,
                                          "start_line": 25,
                                          "start_col": 20
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 632,
                                    "end": 769,
                                    "start_line": 25,
                                    "start_col": 12
                                  }
                                }
                              },
                              "span": {
                                "start": 632,
                                "end": 783,
                                "start_line": 25,
                                "start_col": 12
                              }
                            },
                            {
                              "kind": {
                                "Return": {
                                  "kind": {
                                    "Variable": "data"
                                  },
                                  "span": {
                                    "start": 790,
                                    "end": 795,
                                    "start_line": 30,
                                    "start_col": 19
                                  }
                                }
                              },
                              "span": {
                                "start": 783,
                                "end": 805,
                                "start_line": 30,
                                "start_col": 12
                              }
                            }
                          ],
                          "catches": [
                            {
                              "types": [
                                {
                                  "parts": [
                                    "NotFoundException"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 814,
                                    "end": 832,
                                    "start_line": 31,
                                    "start_col": 17
                                  }
                                }
                              ],
                              "var": "e",
                              "body": [
                                {
                                  "kind": {
                                    "Return": {
                                      "kind": {
                                        "Array": [
                                          {
                                            "key": {
                                              "kind": {
                                                "String": "error"
                                              },
                                              "span": {
                                                "start": 858,
                                                "end": 865,
                                                "start_line": 32,
                                                "start_col": 20
                                              }
                                            },
                                            "value": {
                                              "kind": {
                                                "MethodCall": {
                                                  "object": {
                                                    "kind": {
                                                      "Variable": "e"
                                                    },
                                                    "span": {
                                                      "start": 869,
                                                      "end": 871,
                                                      "start_line": 32,
                                                      "start_col": 31
                                                    }
                                                  },
                                                  "method": {
                                                    "kind": {
                                                      "Identifier": "getMessage"
                                                    },
                                                    "span": {
                                                      "start": 873,
                                                      "end": 883,
                                                      "start_line": 32,
                                                      "start_col": 35
                                                    }
                                                  },
                                                  "args": []
                                                }
                                              },
                                              "span": {
                                                "start": 869,
                                                "end": 885,
                                                "start_line": 32,
                                                "start_col": 31
                                              }
                                            },
                                            "unpack": false,
                                            "span": {
                                              "start": 858,
                                              "end": 885,
                                              "start_line": 32,
                                              "start_col": 20
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 857,
                                        "end": 886,
                                        "start_line": 32,
                                        "start_col": 19
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 850,
                                    "end": 896,
                                    "start_line": 32,
                                    "start_col": 12
                                  }
                                }
                              ],
                              "span": {
                                "start": 813,
                                "end": 898,
                                "start_line": 31,
                                "start_col": 16
                              }
                            }
                          ],
                          "finally": [
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
                                                "start": 920,
                                                "end": 925,
                                                "start_line": 34,
                                                "start_col": 12
                                              }
                                            },
                                            "property": {
                                              "kind": {
                                                "Identifier": "auth"
                                              },
                                              "span": {
                                                "start": 927,
                                                "end": 931,
                                                "start_line": 34,
                                                "start_col": 19
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 920,
                                          "end": 931,
                                          "start_line": 34,
                                          "start_col": 12
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "logAccess"
                                        },
                                        "span": {
                                          "start": 933,
                                          "end": 942,
                                          "start_line": 34,
                                          "start_col": 25
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
                                              "start": 943,
                                              "end": 946,
                                              "start_line": 34,
                                              "start_col": 35
                                            }
                                          },
                                          "unpack": false,
                                          "by_ref": false,
                                          "span": {
                                            "start": 943,
                                            "end": 946,
                                            "start_line": 34,
                                            "start_col": 35
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 920,
                                    "end": 947,
                                    "start_line": 34,
                                    "start_col": 12
                                  }
                                }
                              },
                              "span": {
                                "start": 920,
                                "end": 957,
                                "start_line": 34,
                                "start_col": 12
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 354,
                        "end": 963,
                        "start_line": 18,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 303,
                "end": 970,
                "start_line": 16,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "list",
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
                          "start": 994,
                          "end": 999,
                          "start_line": 38,
                          "start_col": 28
                        }
                      }
                    },
                    "span": {
                      "start": 994,
                      "end": 999,
                      "start_line": 38,
                      "start_col": 28
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
                                  "Variable": "users"
                                },
                                "span": {
                                  "start": 1014,
                                  "end": 1020,
                                  "start_line": 40,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "Identifier": "User"
                                      },
                                      "span": {
                                        "start": 1023,
                                        "end": 1027,
                                        "start_line": 40,
                                        "start_col": 17
                                      }
                                    },
                                    "method": "all",
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 1023,
                                  "end": 1034,
                                  "start_line": 40,
                                  "start_col": 17
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1014,
                            "end": 1034,
                            "start_line": 40,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1014,
                        "end": 1044,
                        "start_line": 40,
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
                                  "Variable": "names"
                                },
                                "span": {
                                  "start": 1044,
                                  "end": 1050,
                                  "start_line": 41,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Identifier": "array_map"
                                      },
                                      "span": {
                                        "start": 1053,
                                        "end": 1062,
                                        "start_line": 41,
                                        "start_col": 17
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
                                                  "name": "u",
                                                  "type_hint": null,
                                                  "default": null,
                                                  "by_ref": false,
                                                  "variadic": false,
                                                  "is_readonly": false,
                                                  "is_final": false,
                                                  "visibility": null,
                                                  "set_visibility": null,
                                                  "attributes": [],
                                                  "span": {
                                                    "start": 1066,
                                                    "end": 1068,
                                                    "start_line": 41,
                                                    "start_col": 30
                                                  }
                                                }
                                              ],
                                              "return_type": null,
                                              "body": {
                                                "kind": {
                                                  "MethodCall": {
                                                    "object": {
                                                      "kind": {
                                                        "Variable": "u"
                                                      },
                                                      "span": {
                                                        "start": 1073,
                                                        "end": 1075,
                                                        "start_line": 41,
                                                        "start_col": 37
                                                      }
                                                    },
                                                    "method": {
                                                      "kind": {
                                                        "Identifier": "getName"
                                                      },
                                                      "span": {
                                                        "start": 1077,
                                                        "end": 1084,
                                                        "start_line": 41,
                                                        "start_col": 41
                                                      }
                                                    },
                                                    "args": []
                                                  }
                                                },
                                                "span": {
                                                  "start": 1073,
                                                  "end": 1086,
                                                  "start_line": 41,
                                                  "start_col": 37
                                                }
                                              },
                                              "attributes": []
                                            }
                                          },
                                          "span": {
                                            "start": 1063,
                                            "end": 1086,
                                            "start_line": 41,
                                            "start_col": 27
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 1063,
                                          "end": 1086,
                                          "start_line": 41,
                                          "start_col": 27
                                        }
                                      },
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Variable": "users"
                                          },
                                          "span": {
                                            "start": 1088,
                                            "end": 1094,
                                            "start_line": 41,
                                            "start_col": 52
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 1088,
                                          "end": 1094,
                                          "start_line": 41,
                                          "start_col": 52
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 1053,
                                  "end": 1095,
                                  "start_line": 41,
                                  "start_col": 17
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1044,
                            "end": 1095,
                            "start_line": 41,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1044,
                        "end": 1105,
                        "start_line": 41,
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
                                  "start": 1105,
                                  "end": 1114,
                                  "start_line": 42,
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
                                        "start": 1117,
                                        "end": 1129,
                                        "start_line": 42,
                                        "start_col": 20
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Variable": "names"
                                          },
                                          "span": {
                                            "start": 1130,
                                            "end": 1136,
                                            "start_line": 42,
                                            "start_col": 33
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 1130,
                                          "end": 1136,
                                          "start_line": 42,
                                          "start_col": 33
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
                                                  "name": "name",
                                                  "type_hint": null,
                                                  "default": null,
                                                  "by_ref": false,
                                                  "variadic": false,
                                                  "is_readonly": false,
                                                  "is_final": false,
                                                  "visibility": null,
                                                  "set_visibility": null,
                                                  "attributes": [],
                                                  "span": {
                                                    "start": 1147,
                                                    "end": 1152,
                                                    "start_line": 42,
                                                    "start_col": 50
                                                  }
                                                }
                                              ],
                                              "use_vars": [
                                                {
                                                  "name": "users",
                                                  "by_ref": false,
                                                  "span": {
                                                    "start": 1159,
                                                    "end": 1165,
                                                    "start_line": 42,
                                                    "start_col": 62
                                                  }
                                                }
                                              ],
                                              "return_type": null,
                                              "body": [
                                                {
                                                  "kind": {
                                                    "Return": {
                                                      "kind": {
                                                        "Binary": {
                                                          "left": {
                                                            "kind": {
                                                              "FunctionCall": {
                                                                "name": {
                                                                  "kind": {
                                                                    "Identifier": "strlen"
                                                                  },
                                                                  "span": {
                                                                    "start": 1188,
                                                                    "end": 1194,
                                                                    "start_line": 43,
                                                                    "start_col": 19
                                                                  }
                                                                },
                                                                "args": [
                                                                  {
                                                                    "name": null,
                                                                    "value": {
                                                                      "kind": {
                                                                        "Variable": "name"
                                                                      },
                                                                      "span": {
                                                                        "start": 1195,
                                                                        "end": 1200,
                                                                        "start_line": 43,
                                                                        "start_col": 26
                                                                      }
                                                                    },
                                                                    "unpack": false,
                                                                    "by_ref": false,
                                                                    "span": {
                                                                      "start": 1195,
                                                                      "end": 1200,
                                                                      "start_line": 43,
                                                                      "start_col": 26
                                                                    }
                                                                  }
                                                                ]
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 1188,
                                                              "end": 1202,
                                                              "start_line": 43,
                                                              "start_col": 19
                                                            }
                                                          },
                                                          "op": "Greater",
                                                          "right": {
                                                            "kind": {
                                                              "Int": 0
                                                            },
                                                            "span": {
                                                              "start": 1204,
                                                              "end": 1205,
                                                              "start_line": 43,
                                                              "start_col": 35
                                                            }
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 1188,
                                                        "end": 1205,
                                                        "start_line": 43,
                                                        "start_col": 19
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1181,
                                                    "end": 1215,
                                                    "start_line": 43,
                                                    "start_col": 12
                                                  }
                                                }
                                              ],
                                              "attributes": []
                                            }
                                          },
                                          "span": {
                                            "start": 1138,
                                            "end": 1216,
                                            "start_line": 42,
                                            "start_col": 41
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 1138,
                                          "end": 1216,
                                          "start_line": 42,
                                          "start_col": 41
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 1117,
                                  "end": 1217,
                                  "start_line": 42,
                                  "start_col": 20
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1105,
                            "end": 1217,
                            "start_line": 42,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1105,
                        "end": 1227,
                        "start_line": 42,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Variable": "filtered"
                          },
                          "span": {
                            "start": 1234,
                            "end": 1243,
                            "start_line": 45,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 1227,
                        "end": 1249,
                        "start_line": 45,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 970,
                "end": 1251,
                "start_line": 38,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 94,
        "end": 1252,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1252,
    "start_line": 1,
    "start_col": 0
  }
}
