===source===
<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Auth\TokenValidator;
use App\Http\Request;
use App\Http\Response;

interface MiddlewareInterface
{
    public function handle(Request $request, callable $next): Response;
}

class AuthMiddleware implements MiddlewareInterface
{
    private readonly TokenValidator $validator;
    private static array $excludedPaths = [];

    public function __construct(TokenValidator $validator)
    {
        $this->validator = $validator;
    }

    public function handle(Request $request, callable $next): Response
    {
        $path = $request->getPath();

        foreach (self::$excludedPaths as $excluded) {
            if ($path === $excluded) {
                return $next($request);
            }
        }

        $token = $request->getHeader('Authorization') ?? '';
        $token = str_replace('Bearer ', '', $token);

        if (empty($token)) {
            return new Response(401, ['error' => 'Missing token']);
        }

        try {
            $claims = $this->validator->validate($token);
            $request->setAttribute('user_id', (int)$claims['sub']);
            $request->setAttribute('roles', $claims['roles'] ?? []);
        } catch (\InvalidArgumentException $e) {
            return new Response(401, ['error' => $e->getMessage()]);
        } catch (\RuntimeException | \LogicException $e) {
            @error_log('Auth error: ' . $e->getMessage());
            return new Response(500, ['error' => 'Internal error']);
        }

        return $next($request);
    }

    public static function exclude(string ...$paths): void
    {
        self::$excludedPaths = [...self::$excludedPaths, ...$paths];
    }
}

class RateLimitMiddleware implements MiddlewareInterface
{
    private const MAX_REQUESTS = 100;
    private const WINDOW_SECONDS = 60;

    public function handle(Request $request, callable $next): Response
    {
        $ip = $request->getIp();
        $key = 'rate:' . $ip;
        $count = $this->getCount($key);

        $remaining = self::MAX_REQUESTS - $count;
        $allowed = $remaining > 0;

        return match (true) {
            !$allowed => new Response(429, ['error' => 'Too many requests']),
            default => $next($request),
        };
    }

    private function getCount(string $key): int
    {
        static $counts = [];
        $counts[$key] = isset($counts[$key]) ? $counts[$key] + 1 : 1;
        return $counts[$key];
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
              "Http",
              "Middleware"
            ],
            "kind": "Qualified",
            "span": {
              "start": 42,
              "end": 61,
              "start_line": 4,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 32,
        "end": 64,
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
                  "Auth",
                  "TokenValidator"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 68,
                  "end": 91,
                  "start_line": 6,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 68,
                "end": 91,
                "start_line": 6,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 64,
        "end": 93,
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
                  "Http",
                  "Request"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 97,
                  "end": 113,
                  "start_line": 7,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 97,
                "end": 113,
                "start_line": 7,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 93,
        "end": 115,
        "start_line": 7,
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
                  "Http",
                  "Response"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 119,
                  "end": 136,
                  "start_line": 8,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 119,
                "end": 136,
                "start_line": 8,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 115,
        "end": 139,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Interface": {
          "name": "MiddlewareInterface",
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "handle",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "request",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Request"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 198,
                              "end": 206,
                              "start_line": 12,
                              "start_col": 27
                            }
                          }
                        },
                        "span": {
                          "start": 198,
                          "end": 206,
                          "start_line": 12,
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
                        "start": 198,
                        "end": 214,
                        "start_line": 12,
                        "start_col": 27
                      }
                    },
                    {
                      "name": "next",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 216,
                              "end": 224,
                              "start_line": 12,
                              "start_col": 45
                            }
                          }
                        },
                        "span": {
                          "start": 216,
                          "end": 224,
                          "start_line": 12,
                          "start_col": 45
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
                        "start": 216,
                        "end": 230,
                        "start_line": 12,
                        "start_col": 45
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Response"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 233,
                          "end": 241,
                          "start_line": 12,
                          "start_col": 62
                        }
                      }
                    },
                    "span": {
                      "start": 233,
                      "end": 241,
                      "start_line": 12,
                      "start_col": 62
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 175,
                "end": 243,
                "start_line": 12,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 139,
        "end": 244,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "AuthMiddleware",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [
            {
              "parts": [
                "MiddlewareInterface"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 278,
                "end": 298,
                "start_line": 15,
                "start_col": 32
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": "validator",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "TokenValidator"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 321,
                          "end": 336,
                          "start_line": 17,
                          "start_col": 21
                        }
                      }
                    },
                    "span": {
                      "start": 321,
                      "end": 336,
                      "start_line": 17,
                      "start_col": 21
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 304,
                "end": 346,
                "start_line": 17,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "excludedPaths",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 367,
                          "end": 372,
                          "start_line": 18,
                          "start_col": 19
                        }
                      }
                    },
                    "span": {
                      "start": 367,
                      "end": 372,
                      "start_line": 18,
                      "start_col": 19
                    }
                  },
                  "default": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 390,
                      "end": 392,
                      "start_line": 18,
                      "start_col": 42
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 352,
                "end": 392,
                "start_line": 18,
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
                      "name": "validator",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "TokenValidator"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 427,
                              "end": 442,
                              "start_line": 20,
                              "start_col": 32
                            }
                          }
                        },
                        "span": {
                          "start": 427,
                          "end": 442,
                          "start_line": 20,
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
                        "start": 427,
                        "end": 452,
                        "start_line": 20,
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
                                        "start": 468,
                                        "end": 473,
                                        "start_line": 22,
                                        "start_col": 8
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "validator"
                                      },
                                      "span": {
                                        "start": 475,
                                        "end": 484,
                                        "start_line": 22,
                                        "start_col": 15
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 468,
                                  "end": 484,
                                  "start_line": 22,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "validator"
                                },
                                "span": {
                                  "start": 487,
                                  "end": 497,
                                  "start_line": 22,
                                  "start_col": 27
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 468,
                            "end": 497,
                            "start_line": 22,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 468,
                        "end": 503,
                        "start_line": 22,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 399,
                "end": 510,
                "start_line": 20,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "handle",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "request",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Request"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 533,
                              "end": 541,
                              "start_line": 25,
                              "start_col": 27
                            }
                          }
                        },
                        "span": {
                          "start": 533,
                          "end": 541,
                          "start_line": 25,
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
                        "start": 533,
                        "end": 549,
                        "start_line": 25,
                        "start_col": 27
                      }
                    },
                    {
                      "name": "next",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 551,
                              "end": 559,
                              "start_line": 25,
                              "start_col": 45
                            }
                          }
                        },
                        "span": {
                          "start": 551,
                          "end": 559,
                          "start_line": 25,
                          "start_col": 45
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
                        "start": 551,
                        "end": 565,
                        "start_line": 25,
                        "start_col": 45
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Response"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 568,
                          "end": 581,
                          "start_line": 25,
                          "start_col": 62
                        }
                      }
                    },
                    "span": {
                      "start": 568,
                      "end": 581,
                      "start_line": 25,
                      "start_col": 62
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
                                  "Variable": "path"
                                },
                                "span": {
                                  "start": 591,
                                  "end": 596,
                                  "start_line": 27,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "Variable": "request"
                                      },
                                      "span": {
                                        "start": 599,
                                        "end": 607,
                                        "start_line": 27,
                                        "start_col": 16
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "getPath"
                                      },
                                      "span": {
                                        "start": 609,
                                        "end": 616,
                                        "start_line": 27,
                                        "start_col": 26
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 599,
                                  "end": 618,
                                  "start_line": 27,
                                  "start_col": 16
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 591,
                            "end": 618,
                            "start_line": 27,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 591,
                        "end": 629,
                        "start_line": 27,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Foreach": {
                          "expr": {
                            "kind": {
                              "StaticPropertyAccess": {
                                "class": {
                                  "kind": {
                                    "Identifier": "self"
                                  },
                                  "span": {
                                    "start": 638,
                                    "end": 642,
                                    "start_line": 29,
                                    "start_col": 17
                                  }
                                },
                                "member": "excludedPaths"
                              }
                            },
                            "span": {
                              "start": 638,
                              "end": 658,
                              "start_line": 29,
                              "start_col": 17
                            }
                          },
                          "key": null,
                          "value": {
                            "kind": {
                              "Variable": "excluded"
                            },
                            "span": {
                              "start": 662,
                              "end": 671,
                              "start_line": 29,
                              "start_col": 41
                            }
                          },
                          "body": {
                            "kind": {
                              "Block": [
                                {
                                  "kind": {
                                    "If": {
                                      "condition": {
                                        "kind": {
                                          "Binary": {
                                            "left": {
                                              "kind": {
                                                "Variable": "path"
                                              },
                                              "span": {
                                                "start": 691,
                                                "end": 696,
                                                "start_line": 30,
                                                "start_col": 16
                                              }
                                            },
                                            "op": "Identical",
                                            "right": {
                                              "kind": {
                                                "Variable": "excluded"
                                              },
                                              "span": {
                                                "start": 701,
                                                "end": 710,
                                                "start_line": 30,
                                                "start_col": 26
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 691,
                                          "end": 710,
                                          "start_line": 30,
                                          "start_col": 16
                                        }
                                      },
                                      "then_branch": {
                                        "kind": {
                                          "Block": [
                                            {
                                              "kind": {
                                                "Return": {
                                                  "kind": {
                                                    "FunctionCall": {
                                                      "name": {
                                                        "kind": {
                                                          "Variable": "next"
                                                        },
                                                        "span": {
                                                          "start": 737,
                                                          "end": 742,
                                                          "start_line": 31,
                                                          "start_col": 23
                                                        }
                                                      },
                                                      "args": [
                                                        {
                                                          "name": null,
                                                          "value": {
                                                            "kind": {
                                                              "Variable": "request"
                                                            },
                                                            "span": {
                                                              "start": 743,
                                                              "end": 751,
                                                              "start_line": 31,
                                                              "start_col": 29
                                                            }
                                                          },
                                                          "unpack": false,
                                                          "by_ref": false,
                                                          "span": {
                                                            "start": 743,
                                                            "end": 751,
                                                            "start_line": 31,
                                                            "start_col": 29
                                                          }
                                                        }
                                                      ]
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 737,
                                                    "end": 752,
                                                    "start_line": 31,
                                                    "start_col": 23
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 730,
                                                "end": 766,
                                                "start_line": 31,
                                                "start_col": 16
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 712,
                                          "end": 767,
                                          "start_line": 30,
                                          "start_col": 37
                                        }
                                      },
                                      "elseif_branches": [],
                                      "else_branch": null
                                    }
                                  },
                                  "span": {
                                    "start": 687,
                                    "end": 767,
                                    "start_line": 30,
                                    "start_col": 12
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 673,
                              "end": 777,
                              "start_line": 29,
                              "start_col": 52
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 629,
                        "end": 777,
                        "start_line": 29,
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
                                  "Variable": "token"
                                },
                                "span": {
                                  "start": 787,
                                  "end": 793,
                                  "start_line": 35,
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
                                              "Variable": "request"
                                            },
                                            "span": {
                                              "start": 796,
                                              "end": 804,
                                              "start_line": 35,
                                              "start_col": 17
                                            }
                                          },
                                          "method": {
                                            "kind": {
                                              "Identifier": "getHeader"
                                            },
                                            "span": {
                                              "start": 806,
                                              "end": 815,
                                              "start_line": 35,
                                              "start_col": 27
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "String": "Authorization"
                                                },
                                                "span": {
                                                  "start": 816,
                                                  "end": 831,
                                                  "start_line": 35,
                                                  "start_col": 37
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 816,
                                                "end": 831,
                                                "start_line": 35,
                                                "start_col": 37
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 796,
                                        "end": 833,
                                        "start_line": 35,
                                        "start_col": 17
                                      }
                                    },
                                    "right": {
                                      "kind": {
                                        "String": ""
                                      },
                                      "span": {
                                        "start": 836,
                                        "end": 838,
                                        "start_line": 35,
                                        "start_col": 57
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 796,
                                  "end": 838,
                                  "start_line": 35,
                                  "start_col": 17
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 787,
                            "end": 838,
                            "start_line": 35,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 787,
                        "end": 848,
                        "start_line": 35,
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
                                  "Variable": "token"
                                },
                                "span": {
                                  "start": 848,
                                  "end": 854,
                                  "start_line": 36,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Identifier": "str_replace"
                                      },
                                      "span": {
                                        "start": 857,
                                        "end": 868,
                                        "start_line": 36,
                                        "start_col": 17
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "String": "Bearer "
                                          },
                                          "span": {
                                            "start": 869,
                                            "end": 878,
                                            "start_line": 36,
                                            "start_col": 29
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 869,
                                          "end": 878,
                                          "start_line": 36,
                                          "start_col": 29
                                        }
                                      },
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "String": ""
                                          },
                                          "span": {
                                            "start": 880,
                                            "end": 882,
                                            "start_line": 36,
                                            "start_col": 40
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 880,
                                          "end": 882,
                                          "start_line": 36,
                                          "start_col": 40
                                        }
                                      },
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Variable": "token"
                                          },
                                          "span": {
                                            "start": 884,
                                            "end": 890,
                                            "start_line": 36,
                                            "start_col": 44
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 884,
                                          "end": 890,
                                          "start_line": 36,
                                          "start_col": 44
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 857,
                                  "end": 891,
                                  "start_line": 36,
                                  "start_col": 17
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 848,
                            "end": 891,
                            "start_line": 36,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 848,
                        "end": 902,
                        "start_line": 36,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "If": {
                          "condition": {
                            "kind": {
                              "Empty": {
                                "kind": {
                                  "Variable": "token"
                                },
                                "span": {
                                  "start": 912,
                                  "end": 918,
                                  "start_line": 38,
                                  "start_col": 18
                                }
                              }
                            },
                            "span": {
                              "start": 906,
                              "end": 919,
                              "start_line": 38,
                              "start_col": 12
                            }
                          },
                          "then_branch": {
                            "kind": {
                              "Block": [
                                {
                                  "kind": {
                                    "Return": {
                                      "kind": {
                                        "New": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Response"
                                            },
                                            "span": {
                                              "start": 946,
                                              "end": 954,
                                              "start_line": 39,
                                              "start_col": 23
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "Int": 401
                                                },
                                                "span": {
                                                  "start": 955,
                                                  "end": 958,
                                                  "start_line": 39,
                                                  "start_col": 32
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 955,
                                                "end": 958,
                                                "start_line": 39,
                                                "start_col": 32
                                              }
                                            },
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "Array": [
                                                    {
                                                      "key": {
                                                        "kind": {
                                                          "String": "error"
                                                        },
                                                        "span": {
                                                          "start": 961,
                                                          "end": 968,
                                                          "start_line": 39,
                                                          "start_col": 38
                                                        }
                                                      },
                                                      "value": {
                                                        "kind": {
                                                          "String": "Missing token"
                                                        },
                                                        "span": {
                                                          "start": 972,
                                                          "end": 987,
                                                          "start_line": 39,
                                                          "start_col": 49
                                                        }
                                                      },
                                                      "unpack": false,
                                                      "span": {
                                                        "start": 961,
                                                        "end": 987,
                                                        "start_line": 39,
                                                        "start_col": 38
                                                      }
                                                    }
                                                  ]
                                                },
                                                "span": {
                                                  "start": 960,
                                                  "end": 988,
                                                  "start_line": 39,
                                                  "start_col": 37
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 960,
                                                "end": 988,
                                                "start_line": 39,
                                                "start_col": 37
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 942,
                                        "end": 989,
                                        "start_line": 39,
                                        "start_col": 19
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 935,
                                    "end": 999,
                                    "start_line": 39,
                                    "start_col": 12
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 921,
                              "end": 1000,
                              "start_line": 38,
                              "start_col": 27
                            }
                          },
                          "elseif_branches": [],
                          "else_branch": null
                        }
                      },
                      "span": {
                        "start": 902,
                        "end": 1000,
                        "start_line": 38,
                        "start_col": 8
                      }
                    },
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
                                          "Variable": "claims"
                                        },
                                        "span": {
                                          "start": 1028,
                                          "end": 1035,
                                          "start_line": 43,
                                          "start_col": 12
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
                                                      "start": 1038,
                                                      "end": 1043,
                                                      "start_line": 43,
                                                      "start_col": 22
                                                    }
                                                  },
                                                  "property": {
                                                    "kind": {
                                                      "Identifier": "validator"
                                                    },
                                                    "span": {
                                                      "start": 1045,
                                                      "end": 1054,
                                                      "start_line": 43,
                                                      "start_col": 29
                                                    }
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1038,
                                                "end": 1054,
                                                "start_line": 43,
                                                "start_col": 22
                                              }
                                            },
                                            "method": {
                                              "kind": {
                                                "Identifier": "validate"
                                              },
                                              "span": {
                                                "start": 1056,
                                                "end": 1064,
                                                "start_line": 43,
                                                "start_col": 40
                                              }
                                            },
                                            "args": [
                                              {
                                                "name": null,
                                                "value": {
                                                  "kind": {
                                                    "Variable": "token"
                                                  },
                                                  "span": {
                                                    "start": 1065,
                                                    "end": 1071,
                                                    "start_line": 43,
                                                    "start_col": 49
                                                  }
                                                },
                                                "unpack": false,
                                                "by_ref": false,
                                                "span": {
                                                  "start": 1065,
                                                  "end": 1071,
                                                  "start_line": 43,
                                                  "start_col": 49
                                                }
                                              }
                                            ]
                                          }
                                        },
                                        "span": {
                                          "start": 1038,
                                          "end": 1072,
                                          "start_line": 43,
                                          "start_col": 22
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1028,
                                    "end": 1072,
                                    "start_line": 43,
                                    "start_col": 12
                                  }
                                }
                              },
                              "span": {
                                "start": 1028,
                                "end": 1086,
                                "start_line": 43,
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
                                          "Variable": "request"
                                        },
                                        "span": {
                                          "start": 1086,
                                          "end": 1094,
                                          "start_line": 44,
                                          "start_col": 12
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "setAttribute"
                                        },
                                        "span": {
                                          "start": 1096,
                                          "end": 1108,
                                          "start_line": 44,
                                          "start_col": 22
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "value": {
                                            "kind": {
                                              "String": "user_id"
                                            },
                                            "span": {
                                              "start": 1109,
                                              "end": 1118,
                                              "start_line": 44,
                                              "start_col": 35
                                            }
                                          },
                                          "unpack": false,
                                          "by_ref": false,
                                          "span": {
                                            "start": 1109,
                                            "end": 1118,
                                            "start_line": 44,
                                            "start_col": 35
                                          }
                                        },
                                        {
                                          "name": null,
                                          "value": {
                                            "kind": {
                                              "Cast": [
                                                "Int",
                                                {
                                                  "kind": {
                                                    "ArrayAccess": {
                                                      "array": {
                                                        "kind": {
                                                          "Variable": "claims"
                                                        },
                                                        "span": {
                                                          "start": 1125,
                                                          "end": 1132,
                                                          "start_line": 44,
                                                          "start_col": 51
                                                        }
                                                      },
                                                      "index": {
                                                        "kind": {
                                                          "String": "sub"
                                                        },
                                                        "span": {
                                                          "start": 1133,
                                                          "end": 1138,
                                                          "start_line": 44,
                                                          "start_col": 59
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1125,
                                                    "end": 1139,
                                                    "start_line": 44,
                                                    "start_col": 51
                                                  }
                                                }
                                              ]
                                            },
                                            "span": {
                                              "start": 1120,
                                              "end": 1139,
                                              "start_line": 44,
                                              "start_col": 46
                                            }
                                          },
                                          "unpack": false,
                                          "by_ref": false,
                                          "span": {
                                            "start": 1120,
                                            "end": 1139,
                                            "start_line": 44,
                                            "start_col": 46
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 1086,
                                    "end": 1140,
                                    "start_line": 44,
                                    "start_col": 12
                                  }
                                }
                              },
                              "span": {
                                "start": 1086,
                                "end": 1154,
                                "start_line": 44,
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
                                          "Variable": "request"
                                        },
                                        "span": {
                                          "start": 1154,
                                          "end": 1162,
                                          "start_line": 45,
                                          "start_col": 12
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "setAttribute"
                                        },
                                        "span": {
                                          "start": 1164,
                                          "end": 1176,
                                          "start_line": 45,
                                          "start_col": 22
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "value": {
                                            "kind": {
                                              "String": "roles"
                                            },
                                            "span": {
                                              "start": 1177,
                                              "end": 1184,
                                              "start_line": 45,
                                              "start_col": 35
                                            }
                                          },
                                          "unpack": false,
                                          "by_ref": false,
                                          "span": {
                                            "start": 1177,
                                            "end": 1184,
                                            "start_line": 45,
                                            "start_col": 35
                                          }
                                        },
                                        {
                                          "name": null,
                                          "value": {
                                            "kind": {
                                              "NullCoalesce": {
                                                "left": {
                                                  "kind": {
                                                    "ArrayAccess": {
                                                      "array": {
                                                        "kind": {
                                                          "Variable": "claims"
                                                        },
                                                        "span": {
                                                          "start": 1186,
                                                          "end": 1193,
                                                          "start_line": 45,
                                                          "start_col": 44
                                                        }
                                                      },
                                                      "index": {
                                                        "kind": {
                                                          "String": "roles"
                                                        },
                                                        "span": {
                                                          "start": 1194,
                                                          "end": 1201,
                                                          "start_line": 45,
                                                          "start_col": 52
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1186,
                                                    "end": 1203,
                                                    "start_line": 45,
                                                    "start_col": 44
                                                  }
                                                },
                                                "right": {
                                                  "kind": {
                                                    "Array": []
                                                  },
                                                  "span": {
                                                    "start": 1206,
                                                    "end": 1208,
                                                    "start_line": 45,
                                                    "start_col": 64
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 1186,
                                              "end": 1208,
                                              "start_line": 45,
                                              "start_col": 44
                                            }
                                          },
                                          "unpack": false,
                                          "by_ref": false,
                                          "span": {
                                            "start": 1186,
                                            "end": 1208,
                                            "start_line": 45,
                                            "start_col": 44
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 1154,
                                    "end": 1209,
                                    "start_line": 45,
                                    "start_col": 12
                                  }
                                }
                              },
                              "span": {
                                "start": 1154,
                                "end": 1219,
                                "start_line": 45,
                                "start_col": 12
                              }
                            }
                          ],
                          "catches": [
                            {
                              "types": [
                                {
                                  "parts": [
                                    "InvalidArgumentException"
                                  ],
                                  "kind": "FullyQualified",
                                  "span": {
                                    "start": 1228,
                                    "end": 1254,
                                    "start_line": 46,
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
                                        "New": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Response"
                                            },
                                            "span": {
                                              "start": 1283,
                                              "end": 1291,
                                              "start_line": 47,
                                              "start_col": 23
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "Int": 401
                                                },
                                                "span": {
                                                  "start": 1292,
                                                  "end": 1295,
                                                  "start_line": 47,
                                                  "start_col": 32
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 1292,
                                                "end": 1295,
                                                "start_line": 47,
                                                "start_col": 32
                                              }
                                            },
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "Array": [
                                                    {
                                                      "key": {
                                                        "kind": {
                                                          "String": "error"
                                                        },
                                                        "span": {
                                                          "start": 1298,
                                                          "end": 1305,
                                                          "start_line": 47,
                                                          "start_col": 38
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
                                                                "start": 1309,
                                                                "end": 1311,
                                                                "start_line": 47,
                                                                "start_col": 49
                                                              }
                                                            },
                                                            "method": {
                                                              "kind": {
                                                                "Identifier": "getMessage"
                                                              },
                                                              "span": {
                                                                "start": 1313,
                                                                "end": 1323,
                                                                "start_line": 47,
                                                                "start_col": 53
                                                              }
                                                            },
                                                            "args": []
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 1309,
                                                          "end": 1325,
                                                          "start_line": 47,
                                                          "start_col": 49
                                                        }
                                                      },
                                                      "unpack": false,
                                                      "span": {
                                                        "start": 1298,
                                                        "end": 1325,
                                                        "start_line": 47,
                                                        "start_col": 38
                                                      }
                                                    }
                                                  ]
                                                },
                                                "span": {
                                                  "start": 1297,
                                                  "end": 1326,
                                                  "start_line": 47,
                                                  "start_col": 37
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 1297,
                                                "end": 1326,
                                                "start_line": 47,
                                                "start_col": 37
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 1279,
                                        "end": 1327,
                                        "start_line": 47,
                                        "start_col": 19
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1272,
                                    "end": 1337,
                                    "start_line": 47,
                                    "start_col": 12
                                  }
                                }
                              ],
                              "span": {
                                "start": 1227,
                                "end": 1339,
                                "start_line": 46,
                                "start_col": 16
                              }
                            },
                            {
                              "types": [
                                {
                                  "parts": [
                                    "RuntimeException"
                                  ],
                                  "kind": "FullyQualified",
                                  "span": {
                                    "start": 1346,
                                    "end": 1364,
                                    "start_line": 48,
                                    "start_col": 17
                                  }
                                },
                                {
                                  "parts": [
                                    "LogicException"
                                  ],
                                  "kind": "FullyQualified",
                                  "span": {
                                    "start": 1366,
                                    "end": 1382,
                                    "start_line": 48,
                                    "start_col": 37
                                  }
                                }
                              ],
                              "var": "e",
                              "body": [
                                {
                                  "kind": {
                                    "Expression": {
                                      "kind": {
                                        "ErrorSuppress": {
                                          "kind": {
                                            "FunctionCall": {
                                              "name": {
                                                "kind": {
                                                  "Identifier": "error_log"
                                                },
                                                "span": {
                                                  "start": 1401,
                                                  "end": 1410,
                                                  "start_line": 49,
                                                  "start_col": 13
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
                                                            "String": "Auth error: "
                                                          },
                                                          "span": {
                                                            "start": 1411,
                                                            "end": 1425,
                                                            "start_line": 49,
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
                                                                  "start": 1428,
                                                                  "end": 1430,
                                                                  "start_line": 49,
                                                                  "start_col": 40
                                                                }
                                                              },
                                                              "method": {
                                                                "kind": {
                                                                  "Identifier": "getMessage"
                                                                },
                                                                "span": {
                                                                  "start": 1432,
                                                                  "end": 1442,
                                                                  "start_line": 49,
                                                                  "start_col": 44
                                                                }
                                                              },
                                                              "args": []
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 1428,
                                                            "end": 1444,
                                                            "start_line": 49,
                                                            "start_col": 40
                                                          }
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 1411,
                                                      "end": 1444,
                                                      "start_line": 49,
                                                      "start_col": 23
                                                    }
                                                  },
                                                  "unpack": false,
                                                  "by_ref": false,
                                                  "span": {
                                                    "start": 1411,
                                                    "end": 1444,
                                                    "start_line": 49,
                                                    "start_col": 23
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 1401,
                                            "end": 1445,
                                            "start_line": 49,
                                            "start_col": 13
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1400,
                                        "end": 1445,
                                        "start_line": 49,
                                        "start_col": 12
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1400,
                                    "end": 1459,
                                    "start_line": 49,
                                    "start_col": 12
                                  }
                                },
                                {
                                  "kind": {
                                    "Return": {
                                      "kind": {
                                        "New": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Response"
                                            },
                                            "span": {
                                              "start": 1470,
                                              "end": 1478,
                                              "start_line": 50,
                                              "start_col": 23
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "Int": 500
                                                },
                                                "span": {
                                                  "start": 1479,
                                                  "end": 1482,
                                                  "start_line": 50,
                                                  "start_col": 32
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 1479,
                                                "end": 1482,
                                                "start_line": 50,
                                                "start_col": 32
                                              }
                                            },
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "Array": [
                                                    {
                                                      "key": {
                                                        "kind": {
                                                          "String": "error"
                                                        },
                                                        "span": {
                                                          "start": 1485,
                                                          "end": 1492,
                                                          "start_line": 50,
                                                          "start_col": 38
                                                        }
                                                      },
                                                      "value": {
                                                        "kind": {
                                                          "String": "Internal error"
                                                        },
                                                        "span": {
                                                          "start": 1496,
                                                          "end": 1512,
                                                          "start_line": 50,
                                                          "start_col": 49
                                                        }
                                                      },
                                                      "unpack": false,
                                                      "span": {
                                                        "start": 1485,
                                                        "end": 1512,
                                                        "start_line": 50,
                                                        "start_col": 38
                                                      }
                                                    }
                                                  ]
                                                },
                                                "span": {
                                                  "start": 1484,
                                                  "end": 1513,
                                                  "start_line": 50,
                                                  "start_col": 37
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 1484,
                                                "end": 1513,
                                                "start_line": 50,
                                                "start_col": 37
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 1466,
                                        "end": 1514,
                                        "start_line": 50,
                                        "start_col": 19
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1459,
                                    "end": 1524,
                                    "start_line": 50,
                                    "start_col": 12
                                  }
                                }
                              ],
                              "span": {
                                "start": 1345,
                                "end": 1535,
                                "start_line": 48,
                                "start_col": 16
                              }
                            }
                          ],
                          "finally": null
                        }
                      },
                      "span": {
                        "start": 1010,
                        "end": 1535,
                        "start_line": 42,
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
                                  "Variable": "next"
                                },
                                "span": {
                                  "start": 1542,
                                  "end": 1547,
                                  "start_line": 53,
                                  "start_col": 15
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "Variable": "request"
                                    },
                                    "span": {
                                      "start": 1548,
                                      "end": 1556,
                                      "start_line": 53,
                                      "start_col": 21
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 1548,
                                    "end": 1556,
                                    "start_line": 53,
                                    "start_col": 21
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 1542,
                            "end": 1557,
                            "start_line": 53,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 1535,
                        "end": 1563,
                        "start_line": 53,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 510,
                "end": 1570,
                "start_line": 25,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "exclude",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "paths",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1601,
                              "end": 1607,
                              "start_line": 56,
                              "start_col": 35
                            }
                          }
                        },
                        "span": {
                          "start": 1601,
                          "end": 1607,
                          "start_line": 56,
                          "start_col": 35
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 1601,
                        "end": 1617,
                        "start_line": 56,
                        "start_col": 35
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
                          "start": 1620,
                          "end": 1624,
                          "start_line": 56,
                          "start_col": 54
                        }
                      }
                    },
                    "span": {
                      "start": 1620,
                      "end": 1624,
                      "start_line": 56,
                      "start_col": 54
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
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Identifier": "self"
                                      },
                                      "span": {
                                        "start": 1639,
                                        "end": 1643,
                                        "start_line": 58,
                                        "start_col": 8
                                      }
                                    },
                                    "member": "excludedPaths"
                                  }
                                },
                                "span": {
                                  "start": 1639,
                                  "end": 1659,
                                  "start_line": 58,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "StaticPropertyAccess": {
                                            "class": {
                                              "kind": {
                                                "Identifier": "self"
                                              },
                                              "span": {
                                                "start": 1666,
                                                "end": 1670,
                                                "start_line": 58,
                                                "start_col": 35
                                              }
                                            },
                                            "member": "excludedPaths"
                                          }
                                        },
                                        "span": {
                                          "start": 1666,
                                          "end": 1686,
                                          "start_line": 58,
                                          "start_col": 35
                                        }
                                      },
                                      "unpack": true,
                                      "span": {
                                        "start": 1663,
                                        "end": 1686,
                                        "start_line": 58,
                                        "start_col": 32
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "paths"
                                        },
                                        "span": {
                                          "start": 1691,
                                          "end": 1697,
                                          "start_line": 58,
                                          "start_col": 60
                                        }
                                      },
                                      "unpack": true,
                                      "span": {
                                        "start": 1688,
                                        "end": 1697,
                                        "start_line": 58,
                                        "start_col": 57
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 1662,
                                  "end": 1698,
                                  "start_line": 58,
                                  "start_col": 31
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1639,
                            "end": 1698,
                            "start_line": 58,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1639,
                        "end": 1704,
                        "start_line": 58,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1570,
                "end": 1706,
                "start_line": 56,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 246,
        "end": 1707,
        "start_line": 15,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "RateLimitMiddleware",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [
            {
              "parts": [
                "MiddlewareInterface"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 1746,
                "end": 1766,
                "start_line": 62,
                "start_col": 37
              }
            }
          ],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "MAX_REQUESTS",
                  "visibility": "Private",
                  "value": {
                    "kind": {
                      "Int": 100
                    },
                    "span": {
                      "start": 1801,
                      "end": 1804,
                      "start_line": 64,
                      "start_col": 33
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 1772,
                "end": 1810,
                "start_line": 64,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "WINDOW_SECONDS",
                  "visibility": "Private",
                  "value": {
                    "kind": {
                      "Int": 60
                    },
                    "span": {
                      "start": 1841,
                      "end": 1843,
                      "start_line": 65,
                      "start_col": 35
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 1810,
                "end": 1850,
                "start_line": 65,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "handle",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "request",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Request"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1873,
                              "end": 1881,
                              "start_line": 67,
                              "start_col": 27
                            }
                          }
                        },
                        "span": {
                          "start": 1873,
                          "end": 1881,
                          "start_line": 67,
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
                        "start": 1873,
                        "end": 1889,
                        "start_line": 67,
                        "start_col": 27
                      }
                    },
                    {
                      "name": "next",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1891,
                              "end": 1899,
                              "start_line": 67,
                              "start_col": 45
                            }
                          }
                        },
                        "span": {
                          "start": 1891,
                          "end": 1899,
                          "start_line": 67,
                          "start_col": 45
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
                        "start": 1891,
                        "end": 1905,
                        "start_line": 67,
                        "start_col": 45
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Response"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 1908,
                          "end": 1921,
                          "start_line": 67,
                          "start_col": 62
                        }
                      }
                    },
                    "span": {
                      "start": 1908,
                      "end": 1921,
                      "start_line": 67,
                      "start_col": 62
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
                                  "Variable": "ip"
                                },
                                "span": {
                                  "start": 1931,
                                  "end": 1934,
                                  "start_line": 69,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "Variable": "request"
                                      },
                                      "span": {
                                        "start": 1937,
                                        "end": 1945,
                                        "start_line": 69,
                                        "start_col": 14
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "getIp"
                                      },
                                      "span": {
                                        "start": 1947,
                                        "end": 1952,
                                        "start_line": 69,
                                        "start_col": 24
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 1937,
                                  "end": 1954,
                                  "start_line": 69,
                                  "start_col": 14
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1931,
                            "end": 1954,
                            "start_line": 69,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1931,
                        "end": 1964,
                        "start_line": 69,
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
                                  "Variable": "key"
                                },
                                "span": {
                                  "start": 1964,
                                  "end": 1968,
                                  "start_line": 70,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "String": "rate:"
                                      },
                                      "span": {
                                        "start": 1971,
                                        "end": 1978,
                                        "start_line": 70,
                                        "start_col": 15
                                      }
                                    },
                                    "op": "Concat",
                                    "right": {
                                      "kind": {
                                        "Variable": "ip"
                                      },
                                      "span": {
                                        "start": 1981,
                                        "end": 1984,
                                        "start_line": 70,
                                        "start_col": 25
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1971,
                                  "end": 1984,
                                  "start_line": 70,
                                  "start_col": 15
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1964,
                            "end": 1984,
                            "start_line": 70,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1964,
                        "end": 1994,
                        "start_line": 70,
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
                                  "Variable": "count"
                                },
                                "span": {
                                  "start": 1994,
                                  "end": 2000,
                                  "start_line": 71,
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
                                        "start": 2003,
                                        "end": 2008,
                                        "start_line": 71,
                                        "start_col": 17
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "getCount"
                                      },
                                      "span": {
                                        "start": 2010,
                                        "end": 2018,
                                        "start_line": 71,
                                        "start_col": 24
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Variable": "key"
                                          },
                                          "span": {
                                            "start": 2019,
                                            "end": 2023,
                                            "start_line": 71,
                                            "start_col": 33
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 2019,
                                          "end": 2023,
                                          "start_line": 71,
                                          "start_col": 33
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 2003,
                                  "end": 2024,
                                  "start_line": 71,
                                  "start_col": 17
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1994,
                            "end": 2024,
                            "start_line": 71,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 1994,
                        "end": 2035,
                        "start_line": 71,
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
                                  "Variable": "remaining"
                                },
                                "span": {
                                  "start": 2035,
                                  "end": 2045,
                                  "start_line": 73,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "self"
                                            },
                                            "span": {
                                              "start": 2048,
                                              "end": 2052,
                                              "start_line": 73,
                                              "start_col": 21
                                            }
                                          },
                                          "member": "MAX_REQUESTS"
                                        }
                                      },
                                      "span": {
                                        "start": 2048,
                                        "end": 2067,
                                        "start_line": 73,
                                        "start_col": 21
                                      }
                                    },
                                    "op": "Sub",
                                    "right": {
                                      "kind": {
                                        "Variable": "count"
                                      },
                                      "span": {
                                        "start": 2069,
                                        "end": 2075,
                                        "start_line": 73,
                                        "start_col": 42
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2048,
                                  "end": 2075,
                                  "start_line": 73,
                                  "start_col": 21
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 2035,
                            "end": 2075,
                            "start_line": 73,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 2035,
                        "end": 2085,
                        "start_line": 73,
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
                                  "Variable": "allowed"
                                },
                                "span": {
                                  "start": 2085,
                                  "end": 2093,
                                  "start_line": 74,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "Variable": "remaining"
                                      },
                                      "span": {
                                        "start": 2096,
                                        "end": 2106,
                                        "start_line": 74,
                                        "start_col": 19
                                      }
                                    },
                                    "op": "Greater",
                                    "right": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 2109,
                                        "end": 2110,
                                        "start_line": 74,
                                        "start_col": 32
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2096,
                                  "end": 2110,
                                  "start_line": 74,
                                  "start_col": 19
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 2085,
                            "end": 2110,
                            "start_line": 74,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 2085,
                        "end": 2121,
                        "start_line": 74,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Match": {
                              "subject": {
                                "kind": {
                                  "Bool": true
                                },
                                "span": {
                                  "start": 2135,
                                  "end": 2139,
                                  "start_line": 76,
                                  "start_col": 22
                                }
                              },
                              "arms": [
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "UnaryPrefix": {
                                          "op": "BooleanNot",
                                          "operand": {
                                            "kind": {
                                              "Variable": "allowed"
                                            },
                                            "span": {
                                              "start": 2156,
                                              "end": 2164,
                                              "start_line": 77,
                                              "start_col": 13
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 2155,
                                        "end": 2164,
                                        "start_line": 77,
                                        "start_col": 12
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "New": {
                                        "class": {
                                          "kind": {
                                            "Identifier": "Response"
                                          },
                                          "span": {
                                            "start": 2172,
                                            "end": 2180,
                                            "start_line": 77,
                                            "start_col": 29
                                          }
                                        },
                                        "args": [
                                          {
                                            "name": null,
                                            "value": {
                                              "kind": {
                                                "Int": 429
                                              },
                                              "span": {
                                                "start": 2181,
                                                "end": 2184,
                                                "start_line": 77,
                                                "start_col": 38
                                              }
                                            },
                                            "unpack": false,
                                            "by_ref": false,
                                            "span": {
                                              "start": 2181,
                                              "end": 2184,
                                              "start_line": 77,
                                              "start_col": 38
                                            }
                                          },
                                          {
                                            "name": null,
                                            "value": {
                                              "kind": {
                                                "Array": [
                                                  {
                                                    "key": {
                                                      "kind": {
                                                        "String": "error"
                                                      },
                                                      "span": {
                                                        "start": 2187,
                                                        "end": 2194,
                                                        "start_line": 77,
                                                        "start_col": 44
                                                      }
                                                    },
                                                    "value": {
                                                      "kind": {
                                                        "String": "Too many requests"
                                                      },
                                                      "span": {
                                                        "start": 2198,
                                                        "end": 2217,
                                                        "start_line": 77,
                                                        "start_col": 55
                                                      }
                                                    },
                                                    "unpack": false,
                                                    "span": {
                                                      "start": 2187,
                                                      "end": 2217,
                                                      "start_line": 77,
                                                      "start_col": 44
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 2186,
                                                "end": 2218,
                                                "start_line": 77,
                                                "start_col": 43
                                              }
                                            },
                                            "unpack": false,
                                            "by_ref": false,
                                            "span": {
                                              "start": 2186,
                                              "end": 2218,
                                              "start_line": 77,
                                              "start_col": 43
                                            }
                                          }
                                        ]
                                      }
                                    },
                                    "span": {
                                      "start": 2168,
                                      "end": 2219,
                                      "start_line": 77,
                                      "start_col": 25
                                    }
                                  },
                                  "span": {
                                    "start": 2155,
                                    "end": 2219,
                                    "start_line": 77,
                                    "start_col": 12
                                  }
                                },
                                {
                                  "conditions": null,
                                  "body": {
                                    "kind": {
                                      "FunctionCall": {
                                        "name": {
                                          "kind": {
                                            "Variable": "next"
                                          },
                                          "span": {
                                            "start": 2244,
                                            "end": 2249,
                                            "start_line": 78,
                                            "start_col": 23
                                          }
                                        },
                                        "args": [
                                          {
                                            "name": null,
                                            "value": {
                                              "kind": {
                                                "Variable": "request"
                                              },
                                              "span": {
                                                "start": 2250,
                                                "end": 2258,
                                                "start_line": 78,
                                                "start_col": 29
                                              }
                                            },
                                            "unpack": false,
                                            "by_ref": false,
                                            "span": {
                                              "start": 2250,
                                              "end": 2258,
                                              "start_line": 78,
                                              "start_col": 29
                                            }
                                          }
                                        ]
                                      }
                                    },
                                    "span": {
                                      "start": 2244,
                                      "end": 2259,
                                      "start_line": 78,
                                      "start_col": 23
                                    }
                                  },
                                  "span": {
                                    "start": 2233,
                                    "end": 2259,
                                    "start_line": 78,
                                    "start_col": 12
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 2128,
                            "end": 2270,
                            "start_line": 76,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 2121,
                        "end": 2276,
                        "start_line": 76,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1850,
                "end": 2283,
                "start_line": 67,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "getCount",
                  "visibility": "Private",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "key",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 2309,
                              "end": 2315,
                              "start_line": 82,
                              "start_col": 30
                            }
                          }
                        },
                        "span": {
                          "start": 2309,
                          "end": 2315,
                          "start_line": 82,
                          "start_col": 30
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
                        "start": 2309,
                        "end": 2320,
                        "start_line": 82,
                        "start_col": 30
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 2323,
                          "end": 2326,
                          "start_line": 82,
                          "start_col": 44
                        }
                      }
                    },
                    "span": {
                      "start": 2323,
                      "end": 2326,
                      "start_line": 82,
                      "start_col": 44
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": "counts",
                            "default": {
                              "kind": {
                                "Array": []
                              },
                              "span": {
                                "start": 2358,
                                "end": 2360,
                                "start_line": 84,
                                "start_col": 25
                              }
                            },
                            "span": {
                              "start": 2348,
                              "end": 2360,
                              "start_line": 84,
                              "start_col": 15
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 2341,
                        "end": 2370,
                        "start_line": 84,
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
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "counts"
                                      },
                                      "span": {
                                        "start": 2370,
                                        "end": 2377,
                                        "start_line": 85,
                                        "start_col": 8
                                      }
                                    },
                                    "index": {
                                      "kind": {
                                        "Variable": "key"
                                      },
                                      "span": {
                                        "start": 2378,
                                        "end": 2382,
                                        "start_line": 85,
                                        "start_col": 16
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2370,
                                  "end": 2384,
                                  "start_line": 85,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
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
                                                    "Variable": "counts"
                                                  },
                                                  "span": {
                                                    "start": 2392,
                                                    "end": 2399,
                                                    "start_line": 85,
                                                    "start_col": 30
                                                  }
                                                },
                                                "index": {
                                                  "kind": {
                                                    "Variable": "key"
                                                  },
                                                  "span": {
                                                    "start": 2400,
                                                    "end": 2404,
                                                    "start_line": 85,
                                                    "start_col": 38
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 2392,
                                              "end": 2405,
                                              "start_line": 85,
                                              "start_col": 30
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 2386,
                                        "end": 2406,
                                        "start_line": 85,
                                        "start_col": 24
                                      }
                                    },
                                    "then_expr": {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "ArrayAccess": {
                                                "array": {
                                                  "kind": {
                                                    "Variable": "counts"
                                                  },
                                                  "span": {
                                                    "start": 2409,
                                                    "end": 2416,
                                                    "start_line": 85,
                                                    "start_col": 47
                                                  }
                                                },
                                                "index": {
                                                  "kind": {
                                                    "Variable": "key"
                                                  },
                                                  "span": {
                                                    "start": 2417,
                                                    "end": 2421,
                                                    "start_line": 85,
                                                    "start_col": 55
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 2409,
                                              "end": 2423,
                                              "start_line": 85,
                                              "start_col": 47
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 2425,
                                              "end": 2426,
                                              "start_line": 85,
                                              "start_col": 63
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 2409,
                                        "end": 2426,
                                        "start_line": 85,
                                        "start_col": 47
                                      }
                                    },
                                    "else_expr": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 2429,
                                        "end": 2430,
                                        "start_line": 85,
                                        "start_col": 67
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2386,
                                  "end": 2430,
                                  "start_line": 85,
                                  "start_col": 24
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 2370,
                            "end": 2430,
                            "start_line": 85,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 2370,
                        "end": 2440,
                        "start_line": 85,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "counts"
                                },
                                "span": {
                                  "start": 2447,
                                  "end": 2454,
                                  "start_line": 86,
                                  "start_col": 15
                                }
                              },
                              "index": {
                                "kind": {
                                  "Variable": "key"
                                },
                                "span": {
                                  "start": 2455,
                                  "end": 2459,
                                  "start_line": 86,
                                  "start_col": 23
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 2447,
                            "end": 2460,
                            "start_line": 86,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 2440,
                        "end": 2466,
                        "start_line": 86,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 2283,
                "end": 2468,
                "start_line": 82,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1709,
        "end": 2469,
        "start_line": 62,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 2469,
    "start_line": 1,
    "start_col": 0
  }
}
