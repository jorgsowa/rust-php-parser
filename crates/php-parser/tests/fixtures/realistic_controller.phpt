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
              "end": 31
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 32
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
                  "end": 53
                }
              },
              "alias": null,
              "span": {
                "start": 38,
                "end": 53
              }
            }
          ]
        }
      },
      "span": {
        "start": 34,
        "end": 54
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
                  "end": 83
                }
              },
              "alias": {
                "name": "Auth",
                "span": {
                  "start": 87,
                  "end": 91
                }
              },
              "span": {
                "start": 59,
                "end": 91
              }
            }
          ]
        }
      },
      "span": {
        "start": 55,
        "end": 92
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "UserController",
            "span": {
              "start": 100,
              "end": 114
            }
          },
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
              "end": 137
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
                "end": 162
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "auth",
                    "span": {
                      "start": 198,
                      "end": 203
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "AuthService"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 186,
                          "end": 197
                        }
                      }
                    },
                    "span": {
                      "start": 186,
                      "end": 197
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 169,
                "end": 203
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 226,
                      "end": 237
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "auth",
                        "span": {
                          "start": 250,
                          "end": 255
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "AuthService"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 238,
                              "end": 249
                            }
                          }
                        },
                        "span": {
                          "start": 238,
                          "end": 249
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 238,
                        "end": 255
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
                                        "end": 276
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "auth"
                                      },
                                      "span": {
                                        "start": 278,
                                        "end": 282
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 271,
                                  "end": 282
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "auth"
                                },
                                "span": {
                                  "start": 285,
                                  "end": 290
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 271,
                            "end": 290
                          }
                        }
                      },
                      "span": {
                        "start": 271,
                        "end": 291
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 210,
                "end": 297
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "show",
                    "span": {
                      "start": 319,
                      "end": 323
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "id",
                        "span": {
                          "start": 328,
                          "end": 331
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 324,
                              "end": 327
                            }
                          }
                        },
                        "span": {
                          "start": 324,
                          "end": 327
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 324,
                        "end": 331
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
                          "end": 339
                        }
                      }
                    },
                    "span": {
                      "start": 334,
                      "end": 339
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
                                          "end": 377
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
                                                      "Name": {
                                                        "parts": [
                                                          "User"
                                                        ],
                                                        "kind": "Unqualified",
                                                        "span": {
                                                          "start": 380,
                                                          "end": 384
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 380,
                                                      "end": 384
                                                    }
                                                  },
                                                  "method": {
                                                    "kind": {
                                                      "Identifier": "find"
                                                    },
                                                    "span": {
                                                      "start": 386,
                                                      "end": 390
                                                    }
                                                  },
                                                  "args": [
                                                    {
                                                      "name": null,
                                                      "kind": {
                                                        "Value": {
                                                          "kind": {
                                                            "Variable": "id"
                                                          },
                                                          "span": {
                                                            "start": 391,
                                                            "end": 394
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 391,
                                                        "end": 394
                                                      }
                                                    }
                                                  ]
                                                }
                                              },
                                              "span": {
                                                "start": 380,
                                                "end": 395
                                              }
                                            },
                                            "right": {
                                              "kind": {
                                                "Throw": {
                                                  "kind": {
                                                    "New": {
                                                      "class": {
                                                        "kind": {
                                                          "Name": {
                                                            "parts": [
                                                              "NotFoundException"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 409,
                                                              "end": 426
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 409,
                                                          "end": 426
                                                        }
                                                      },
                                                      "args": [
                                                        {
                                                          "name": null,
                                                          "kind": {
                                                            "Value": {
                                                              "kind": {
                                                                "String": "User not found"
                                                              },
                                                              "span": {
                                                                "start": 427,
                                                                "end": 443
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 427,
                                                            "end": 443
                                                          }
                                                        }
                                                      ]
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 405,
                                                    "end": 444
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 399,
                                                "end": 444
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 380,
                                          "end": 444
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 372,
                                    "end": 444
                                  }
                                }
                              },
                              "span": {
                                "start": 372,
                                "end": 445
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
                                          "end": 463
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
                                                      "end": 478
                                                    }
                                                  },
                                                  "property": {
                                                    "kind": {
                                                      "Identifier": "role"
                                                    },
                                                    "span": {
                                                      "start": 480,
                                                      "end": 484
                                                    }
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 473,
                                                "end": 484
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
                                                      "end": 511
                                                    }
                                                  }
                                                ],
                                                "body": {
                                                  "kind": {
                                                    "String": "Administrator"
                                                  },
                                                  "span": {
                                                    "start": 515,
                                                    "end": 530
                                                  }
                                                },
                                                "span": {
                                                  "start": 504,
                                                  "end": 530
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
                                                      "end": 556
                                                    }
                                                  }
                                                ],
                                                "body": {
                                                  "kind": {
                                                    "String": "Editor"
                                                  },
                                                  "span": {
                                                    "start": 560,
                                                    "end": 568
                                                  }
                                                },
                                                "span": {
                                                  "start": 548,
                                                  "end": 568
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
                                                    "end": 603
                                                  }
                                                },
                                                "span": {
                                                  "start": 586,
                                                  "end": 603
                                                }
                                              }
                                            ]
                                          }
                                        },
                                        "span": {
                                          "start": 466,
                                          "end": 618
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 458,
                                    "end": 618
                                  }
                                }
                              },
                              "span": {
                                "start": 458,
                                "end": 619
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
                                          "end": 637
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
                                                  "end": 664
                                                }
                                              },
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "PropertyAccess": {
                                                      "object": {
                                                        "kind": {
                                                          "Variable": "user"
                                                        },
                                                        "span": {
                                                          "start": 668,
                                                          "end": 673
                                                        }
                                                      },
                                                      "property": {
                                                        "kind": {
                                                          "Identifier": "name"
                                                        },
                                                        "span": {
                                                          "start": 675,
                                                          "end": 679
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 668,
                                                    "end": 679
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 658,
                                                "end": 679
                                              }
                                            },
                                            {
                                              "key": {
                                                "kind": {
                                                  "String": "email"
                                                },
                                                "span": {
                                                  "start": 697,
                                                  "end": 704
                                                }
                                              },
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "NullsafePropertyAccess": {
                                                      "object": {
                                                        "kind": {
                                                          "Variable": "user"
                                                        },
                                                        "span": {
                                                          "start": 708,
                                                          "end": 713
                                                        }
                                                      },
                                                      "property": {
                                                        "kind": {
                                                          "Identifier": "email"
                                                        },
                                                        "span": {
                                                          "start": 716,
                                                          "end": 721
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 708,
                                                    "end": 721
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 697,
                                                "end": 721
                                              }
                                            },
                                            {
                                              "key": {
                                                "kind": {
                                                  "String": "role"
                                                },
                                                "span": {
                                                  "start": 739,
                                                  "end": 745
                                                }
                                              },
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Variable": "role"
                                                  },
                                                  "span": {
                                                    "start": 749,
                                                    "end": 754
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 739,
                                                "end": 754
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 640,
                                          "end": 769
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 632,
                                    "end": 769
                                  }
                                }
                              },
                              "span": {
                                "start": 632,
                                "end": 770
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
                                    "end": 795
                                  }
                                }
                              },
                              "span": {
                                "start": 783,
                                "end": 796
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
                                    "end": 831
                                  }
                                }
                              ],
                              "var": {
                                "name": "e",
                                "span": {
                                  "start": 832,
                                  "end": 834
                                }
                              },
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
                                                "end": 865
                                              }
                                            },
                                            "kind": {
                                              "Value": {
                                                "kind": {
                                                  "MethodCall": {
                                                    "object": {
                                                      "kind": {
                                                        "Variable": "e"
                                                      },
                                                      "span": {
                                                        "start": 869,
                                                        "end": 871
                                                      }
                                                    },
                                                    "method": {
                                                      "kind": {
                                                        "Identifier": "getMessage"
                                                      },
                                                      "span": {
                                                        "start": 873,
                                                        "end": 883
                                                      }
                                                    },
                                                    "args": []
                                                  }
                                                },
                                                "span": {
                                                  "start": 869,
                                                  "end": 885
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 858,
                                              "end": 885
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 857,
                                        "end": 886
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 850,
                                    "end": 887
                                  }
                                }
                              ],
                              "span": {
                                "start": 813,
                                "end": 897
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
                                                "end": 925
                                              }
                                            },
                                            "property": {
                                              "kind": {
                                                "Identifier": "auth"
                                              },
                                              "span": {
                                                "start": 927,
                                                "end": 931
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 920,
                                          "end": 931
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "logAccess"
                                        },
                                        "span": {
                                          "start": 933,
                                          "end": 942
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "id"
                                              },
                                              "span": {
                                                "start": 943,
                                                "end": 946
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 943,
                                            "end": 946
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 920,
                                    "end": 947
                                  }
                                }
                              },
                              "span": {
                                "start": 920,
                                "end": 948
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 354,
                        "end": 958
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 303,
                "end": 964
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "list",
                    "span": {
                      "start": 986,
                      "end": 990
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                          "end": 999
                        }
                      }
                    },
                    "span": {
                      "start": 994,
                      "end": 999
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
                                  "end": 1020
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "User"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 1023,
                                            "end": 1027
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1023,
                                        "end": 1027
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "all"
                                      },
                                      "span": {
                                        "start": 1029,
                                        "end": 1032
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 1023,
                                  "end": 1034
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1014,
                            "end": 1034
                          }
                        }
                      },
                      "span": {
                        "start": 1014,
                        "end": 1035
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
                                  "end": 1050
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "array_map"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 1053,
                                            "end": 1062
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1053,
                                        "end": 1062
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "ArrowFunction": {
                                                "is_static": false,
                                                "by_ref": false,
                                                "params": [
                                                  {
                                                    "name": {
                                                      "name": "u",
                                                      "span": {
                                                        "start": 1066,
                                                        "end": 1068
                                                      }
                                                    },
                                                    "type_hint": null,
                                                    "default": null,
                                                    "by_ref": false,
                                                    "variadic": false,
                                                    "attributes": [],
                                                    "span": {
                                                      "start": 1066,
                                                      "end": 1068
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
                                                          "end": 1075
                                                        }
                                                      },
                                                      "method": {
                                                        "kind": {
                                                          "Identifier": "getName"
                                                        },
                                                        "span": {
                                                          "start": 1077,
                                                          "end": 1084
                                                        }
                                                      },
                                                      "args": []
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1073,
                                                    "end": 1086
                                                  }
                                                },
                                                "attributes": []
                                              }
                                            },
                                            "span": {
                                              "start": 1063,
                                              "end": 1086
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 1063,
                                          "end": 1086
                                        }
                                      },
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "users"
                                            },
                                            "span": {
                                              "start": 1088,
                                              "end": 1094
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 1088,
                                          "end": 1094
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 1053,
                                  "end": 1095
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1044,
                            "end": 1095
                          }
                        }
                      },
                      "span": {
                        "start": 1044,
                        "end": 1096
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
                                  "end": 1114
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "array_filter"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 1117,
                                            "end": 1129
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1117,
                                        "end": 1129
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "names"
                                            },
                                            "span": {
                                              "start": 1130,
                                              "end": 1136
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 1130,
                                          "end": 1136
                                        }
                                      },
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Closure": {
                                                "is_static": false,
                                                "by_ref": false,
                                                "params": [
                                                  {
                                                    "name": {
                                                      "name": "name",
                                                      "span": {
                                                        "start": 1147,
                                                        "end": 1152
                                                      }
                                                    },
                                                    "type_hint": null,
                                                    "default": null,
                                                    "by_ref": false,
                                                    "variadic": false,
                                                    "attributes": [],
                                                    "span": {
                                                      "start": 1147,
                                                      "end": 1152
                                                    }
                                                  }
                                                ],
                                                "use_vars": [
                                                  {
                                                    "name": {
                                                      "name": "users",
                                                      "span": {
                                                        "start": 1159,
                                                        "end": 1165
                                                      }
                                                    },
                                                    "by_ref": false,
                                                    "span": {
                                                      "start": 1159,
                                                      "end": 1165
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
                                                                      "Name": {
                                                                        "parts": [
                                                                          "strlen"
                                                                        ],
                                                                        "kind": "Unqualified",
                                                                        "span": {
                                                                          "start": 1188,
                                                                          "end": 1194
                                                                        }
                                                                      }
                                                                    },
                                                                    "span": {
                                                                      "start": 1188,
                                                                      "end": 1194
                                                                    }
                                                                  },
                                                                  "args": [
                                                                    {
                                                                      "name": null,
                                                                      "kind": {
                                                                        "Value": {
                                                                          "kind": {
                                                                            "Variable": "name"
                                                                          },
                                                                          "span": {
                                                                            "start": 1195,
                                                                            "end": 1200
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1195,
                                                                        "end": 1200
                                                                      }
                                                                    }
                                                                  ]
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1188,
                                                                "end": 1201
                                                              }
                                                            },
                                                            "op": "Greater",
                                                            "right": {
                                                              "kind": {
                                                                "Int": 0
                                                              },
                                                              "span": {
                                                                "start": 1204,
                                                                "end": 1205
                                                              }
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 1188,
                                                          "end": 1205
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 1181,
                                                      "end": 1206
                                                    }
                                                  }
                                                ],
                                                "attributes": []
                                              }
                                            },
                                            "span": {
                                              "start": 1138,
                                              "end": 1216
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 1138,
                                          "end": 1216
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 1117,
                                  "end": 1217
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1105,
                            "end": 1217
                          }
                        }
                      },
                      "span": {
                        "start": 1105,
                        "end": 1218
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
                            "end": 1243
                          }
                        }
                      },
                      "span": {
                        "start": 1227,
                        "end": 1244
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 970,
                "end": 1250
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 94,
        "end": 1252
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1252
  }
}
