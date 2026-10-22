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
===errors <=7.4===
'readonly properties' requires PHP 8.1 or higher
'match expressions' requires PHP 8.0 or higher
===errors 8.0===
'readonly properties' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'TokenValidator' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 17
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "TokenValidator", expecting variable in Standard input code on line 17
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
                  "end": 28
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 30
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
              "end": 61
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 32,
        "end": 62
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
                  "end": 91
                }
              },
              "alias": null,
              "span": {
                "start": 68,
                "end": 91
              }
            }
          ]
        }
      },
      "span": {
        "start": 64,
        "end": 92
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
                  "end": 113
                }
              },
              "alias": null,
              "span": {
                "start": 97,
                "end": 113
              }
            }
          ]
        }
      },
      "span": {
        "start": 93,
        "end": 114
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
                  "end": 136
                }
              },
              "alias": null,
              "span": {
                "start": 119,
                "end": 136
              }
            }
          ]
        }
      },
      "span": {
        "start": 115,
        "end": 137
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "MiddlewareInterface",
            "span": {
              "start": 149,
              "end": 168
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "handle",
                    "span": {
                      "start": 191,
                      "end": 197
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "request",
                        "span": {
                          "start": 206,
                          "end": 214
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Request"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 198,
                              "end": 205
                            }
                          }
                        },
                        "span": {
                          "start": 198,
                          "end": 205
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 198,
                        "end": 214
                      }
                    },
                    {
                      "name": {
                        "name": "next",
                        "span": {
                          "start": 225,
                          "end": 230
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 216,
                              "end": 224
                            }
                          }
                        },
                        "span": {
                          "start": 216,
                          "end": 224
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 216,
                        "end": 230
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
                          "end": 241
                        }
                      }
                    },
                    "span": {
                      "start": 233,
                      "end": 241
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 175,
                "end": 242
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 139,
        "end": 244
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "AuthMiddleware",
            "span": {
              "start": 252,
              "end": 266
            }
          },
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
                "end": 297
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "validator",
                    "span": {
                      "start": 336,
                      "end": 346
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
                          "TokenValidator"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 321,
                          "end": 335
                        }
                      }
                    },
                    "span": {
                      "start": 321,
                      "end": 335
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 304,
                "end": 346
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "excludedPaths",
                    "span": {
                      "start": 373,
                      "end": 387
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 367,
                          "end": 372
                        }
                      }
                    },
                    "span": {
                      "start": 367,
                      "end": 372
                    }
                  },
                  "default": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 390,
                      "end": 392
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 352,
                "end": 392
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 415,
                      "end": 426
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "validator",
                        "span": {
                          "start": 442,
                          "end": 452
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "TokenValidator"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 427,
                              "end": 441
                            }
                          }
                        },
                        "span": {
                          "start": 427,
                          "end": 441
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 427,
                        "end": 452
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
                                        "end": 473
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "validator"
                                      },
                                      "span": {
                                        "start": 475,
                                        "end": 484
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 468,
                                  "end": 484
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "validator"
                                },
                                "span": {
                                  "start": 487,
                                  "end": 497
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 468,
                            "end": 497
                          }
                        }
                      },
                      "span": {
                        "start": 468,
                        "end": 498
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 399,
                "end": 504
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "handle",
                    "span": {
                      "start": 526,
                      "end": 532
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "request",
                        "span": {
                          "start": 541,
                          "end": 549
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Request"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 533,
                              "end": 540
                            }
                          }
                        },
                        "span": {
                          "start": 533,
                          "end": 540
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 533,
                        "end": 549
                      }
                    },
                    {
                      "name": {
                        "name": "next",
                        "span": {
                          "start": 560,
                          "end": 565
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 551,
                              "end": 559
                            }
                          }
                        },
                        "span": {
                          "start": 551,
                          "end": 559
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 551,
                        "end": 565
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
                          "end": 576
                        }
                      }
                    },
                    "span": {
                      "start": 568,
                      "end": 576
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
                                  "end": 596
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
                                        "end": 607
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "getPath"
                                      },
                                      "span": {
                                        "start": 609,
                                        "end": 616
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 599,
                                  "end": 618
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 591,
                            "end": 618
                          }
                        }
                      },
                      "span": {
                        "start": 591,
                        "end": 619
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
                                    "Name": {
                                      "parts": [
                                        "self"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 638,
                                        "end": 642
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 638,
                                    "end": 642
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "excludedPaths"
                                  },
                                  "span": {
                                    "start": 644,
                                    "end": 658
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 638,
                              "end": 658
                            }
                          },
                          "key": null,
                          "value": {
                            "kind": {
                              "Variable": "excluded"
                            },
                            "span": {
                              "start": 662,
                              "end": 671
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
                                                "end": 696
                                              }
                                            },
                                            "op": "Identical",
                                            "right": {
                                              "kind": {
                                                "Variable": "excluded"
                                              },
                                              "span": {
                                                "start": 701,
                                                "end": 710
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 691,
                                          "end": 710
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
                                                          "end": 742
                                                        }
                                                      },
                                                      "args": [
                                                        {
                                                          "name": null,
                                                          "kind": {
                                                            "Value": {
                                                              "kind": {
                                                                "Variable": "request"
                                                              },
                                                              "span": {
                                                                "start": 743,
                                                                "end": 751
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 743,
                                                            "end": 751
                                                          }
                                                        }
                                                      ]
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 737,
                                                    "end": 752
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 730,
                                                "end": 753
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 712,
                                          "end": 767
                                        }
                                      },
                                      "elseif_branches": [],
                                      "else_branch": null
                                    }
                                  },
                                  "span": {
                                    "start": 687,
                                    "end": 767
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 673,
                              "end": 777
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 629,
                        "end": 777
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
                                  "end": 793
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
                                              "end": 804
                                            }
                                          },
                                          "method": {
                                            "kind": {
                                              "Identifier": "getHeader"
                                            },
                                            "span": {
                                              "start": 806,
                                              "end": 815
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "String": "Authorization"
                                                  },
                                                  "span": {
                                                    "start": 816,
                                                    "end": 831
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 816,
                                                "end": 831
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 796,
                                        "end": 832
                                      }
                                    },
                                    "right": {
                                      "kind": {
                                        "String": ""
                                      },
                                      "span": {
                                        "start": 836,
                                        "end": 838
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 796,
                                  "end": 838
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 787,
                            "end": 838
                          }
                        }
                      },
                      "span": {
                        "start": 787,
                        "end": 839
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
                                  "end": 854
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
                                            "str_replace"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 857,
                                            "end": 868
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 857,
                                        "end": 868
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": "Bearer "
                                            },
                                            "span": {
                                              "start": 869,
                                              "end": 878
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 869,
                                          "end": 878
                                        }
                                      },
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": ""
                                            },
                                            "span": {
                                              "start": 880,
                                              "end": 882
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 880,
                                          "end": 882
                                        }
                                      },
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "token"
                                            },
                                            "span": {
                                              "start": 884,
                                              "end": 890
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 884,
                                          "end": 890
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 857,
                                  "end": 891
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 848,
                            "end": 891
                          }
                        }
                      },
                      "span": {
                        "start": 848,
                        "end": 892
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
                                  "end": 918
                                }
                              }
                            },
                            "span": {
                              "start": 906,
                              "end": 919
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
                                              "Name": {
                                                "parts": [
                                                  "Response"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 946,
                                                  "end": 954
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 946,
                                              "end": 954
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Int": 401
                                                  },
                                                  "span": {
                                                    "start": 955,
                                                    "end": 958
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 955,
                                                "end": 958
                                              }
                                            },
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Array": [
                                                      {
                                                        "key": {
                                                          "kind": {
                                                            "String": "error"
                                                          },
                                                          "span": {
                                                            "start": 961,
                                                            "end": 968
                                                          }
                                                        },
                                                        "kind": {
                                                          "Value": {
                                                            "kind": {
                                                              "String": "Missing token"
                                                            },
                                                            "span": {
                                                              "start": 972,
                                                              "end": 987
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 961,
                                                          "end": 987
                                                        }
                                                      }
                                                    ]
                                                  },
                                                  "span": {
                                                    "start": 960,
                                                    "end": 988
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 960,
                                                "end": 988
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 942,
                                        "end": 989
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 935,
                                    "end": 990
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 921,
                              "end": 1000
                            }
                          },
                          "elseif_branches": [],
                          "else_branch": null
                        }
                      },
                      "span": {
                        "start": 902,
                        "end": 1000
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
                                          "end": 1035
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
                                                      "end": 1043
                                                    }
                                                  },
                                                  "property": {
                                                    "kind": {
                                                      "Identifier": "validator"
                                                    },
                                                    "span": {
                                                      "start": 1045,
                                                      "end": 1054
                                                    }
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1038,
                                                "end": 1054
                                              }
                                            },
                                            "method": {
                                              "kind": {
                                                "Identifier": "validate"
                                              },
                                              "span": {
                                                "start": 1056,
                                                "end": 1064
                                              }
                                            },
                                            "args": [
                                              {
                                                "name": null,
                                                "kind": {
                                                  "Value": {
                                                    "kind": {
                                                      "Variable": "token"
                                                    },
                                                    "span": {
                                                      "start": 1065,
                                                      "end": 1071
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1065,
                                                  "end": 1071
                                                }
                                              }
                                            ]
                                          }
                                        },
                                        "span": {
                                          "start": 1038,
                                          "end": 1072
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1028,
                                    "end": 1072
                                  }
                                }
                              },
                              "span": {
                                "start": 1028,
                                "end": 1073
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
                                          "end": 1094
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "setAttribute"
                                        },
                                        "span": {
                                          "start": 1096,
                                          "end": 1108
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "String": "user_id"
                                              },
                                              "span": {
                                                "start": 1109,
                                                "end": 1118
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1109,
                                            "end": 1118
                                          }
                                        },
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
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
                                                            "end": 1132
                                                          }
                                                        },
                                                        "index": {
                                                          "kind": {
                                                            "String": "sub"
                                                          },
                                                          "span": {
                                                            "start": 1133,
                                                            "end": 1138
                                                          }
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 1125,
                                                      "end": 1139
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 1120,
                                                "end": 1139
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1120,
                                            "end": 1139
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 1086,
                                    "end": 1140
                                  }
                                }
                              },
                              "span": {
                                "start": 1086,
                                "end": 1141
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
                                          "end": 1162
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "setAttribute"
                                        },
                                        "span": {
                                          "start": 1164,
                                          "end": 1176
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "String": "roles"
                                              },
                                              "span": {
                                                "start": 1177,
                                                "end": 1184
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1177,
                                            "end": 1184
                                          }
                                        },
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
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
                                                            "end": 1193
                                                          }
                                                        },
                                                        "index": {
                                                          "kind": {
                                                            "String": "roles"
                                                          },
                                                          "span": {
                                                            "start": 1194,
                                                            "end": 1201
                                                          }
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 1186,
                                                      "end": 1202
                                                    }
                                                  },
                                                  "right": {
                                                    "kind": {
                                                      "Array": []
                                                    },
                                                    "span": {
                                                      "start": 1206,
                                                      "end": 1208
                                                    }
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1186,
                                                "end": 1208
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1186,
                                            "end": 1208
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 1154,
                                    "end": 1209
                                  }
                                }
                              },
                              "span": {
                                "start": 1154,
                                "end": 1210
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
                                    "end": 1253
                                  }
                                }
                              ],
                              "var": {
                                "name": "e",
                                "span": {
                                  "start": 1254,
                                  "end": 1256
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
                                              "Name": {
                                                "parts": [
                                                  "Response"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 1283,
                                                  "end": 1291
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 1283,
                                              "end": 1291
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Int": 401
                                                  },
                                                  "span": {
                                                    "start": 1292,
                                                    "end": 1295
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1292,
                                                "end": 1295
                                              }
                                            },
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Array": [
                                                      {
                                                        "key": {
                                                          "kind": {
                                                            "String": "error"
                                                          },
                                                          "span": {
                                                            "start": 1298,
                                                            "end": 1305
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
                                                                    "start": 1309,
                                                                    "end": 1311
                                                                  }
                                                                },
                                                                "method": {
                                                                  "kind": {
                                                                    "Identifier": "getMessage"
                                                                  },
                                                                  "span": {
                                                                    "start": 1313,
                                                                    "end": 1323
                                                                  }
                                                                },
                                                                "args": []
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 1309,
                                                              "end": 1325
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 1298,
                                                          "end": 1325
                                                        }
                                                      }
                                                    ]
                                                  },
                                                  "span": {
                                                    "start": 1297,
                                                    "end": 1326
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1297,
                                                "end": 1326
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 1279,
                                        "end": 1327
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1272,
                                    "end": 1328
                                  }
                                }
                              ],
                              "span": {
                                "start": 1227,
                                "end": 1338
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
                                    "end": 1363
                                  }
                                },
                                {
                                  "parts": [
                                    "LogicException"
                                  ],
                                  "kind": "FullyQualified",
                                  "span": {
                                    "start": 1366,
                                    "end": 1381
                                  }
                                }
                              ],
                              "var": {
                                "name": "e",
                                "span": {
                                  "start": 1382,
                                  "end": 1384
                                }
                              },
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
                                                  "Name": {
                                                    "parts": [
                                                      "error_log"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 1401,
                                                      "end": 1410
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1401,
                                                  "end": 1410
                                                }
                                              },
                                              "args": [
                                                {
                                                  "name": null,
                                                  "kind": {
                                                    "Value": {
                                                      "kind": {
                                                        "Binary": {
                                                          "left": {
                                                            "kind": {
                                                              "String": "Auth error: "
                                                            },
                                                            "span": {
                                                              "start": 1411,
                                                              "end": 1425
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
                                                                    "end": 1430
                                                                  }
                                                                },
                                                                "method": {
                                                                  "kind": {
                                                                    "Identifier": "getMessage"
                                                                  },
                                                                  "span": {
                                                                    "start": 1432,
                                                                    "end": 1442
                                                                  }
                                                                },
                                                                "args": []
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 1428,
                                                              "end": 1444
                                                            }
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 1411,
                                                        "end": 1444
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1411,
                                                    "end": 1444
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 1401,
                                            "end": 1445
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1400,
                                        "end": 1445
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1400,
                                    "end": 1446
                                  }
                                },
                                {
                                  "kind": {
                                    "Return": {
                                      "kind": {
                                        "New": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "Response"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 1470,
                                                  "end": 1478
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 1470,
                                              "end": 1478
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Int": 500
                                                  },
                                                  "span": {
                                                    "start": 1479,
                                                    "end": 1482
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1479,
                                                "end": 1482
                                              }
                                            },
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Array": [
                                                      {
                                                        "key": {
                                                          "kind": {
                                                            "String": "error"
                                                          },
                                                          "span": {
                                                            "start": 1485,
                                                            "end": 1492
                                                          }
                                                        },
                                                        "kind": {
                                                          "Value": {
                                                            "kind": {
                                                              "String": "Internal error"
                                                            },
                                                            "span": {
                                                              "start": 1496,
                                                              "end": 1512
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 1485,
                                                          "end": 1512
                                                        }
                                                      }
                                                    ]
                                                  },
                                                  "span": {
                                                    "start": 1484,
                                                    "end": 1513
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1484,
                                                "end": 1513
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 1466,
                                        "end": 1514
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1459,
                                    "end": 1515
                                  }
                                }
                              ],
                              "span": {
                                "start": 1345,
                                "end": 1525
                              }
                            }
                          ],
                          "finally": null
                        }
                      },
                      "span": {
                        "start": 1010,
                        "end": 1525
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
                                  "end": 1547
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Variable": "request"
                                      },
                                      "span": {
                                        "start": 1548,
                                        "end": 1556
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1548,
                                    "end": 1556
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 1542,
                            "end": 1557
                          }
                        }
                      },
                      "span": {
                        "start": 1535,
                        "end": 1558
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 510,
                "end": 1564
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "exclude",
                    "span": {
                      "start": 1593,
                      "end": 1600
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "paths",
                        "span": {
                          "start": 1611,
                          "end": 1617
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1601,
                              "end": 1607
                            }
                          }
                        },
                        "span": {
                          "start": 1601,
                          "end": 1607
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "attributes": [],
                      "span": {
                        "start": 1601,
                        "end": 1617
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
                          "end": 1624
                        }
                      }
                    },
                    "span": {
                      "start": 1620,
                      "end": 1624
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
                                        "Name": {
                                          "parts": [
                                            "self"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 1639,
                                            "end": 1643
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1639,
                                        "end": 1643
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "excludedPaths"
                                      },
                                      "span": {
                                        "start": 1645,
                                        "end": 1659
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1639,
                                  "end": 1659
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "kind": {
                                        "Spread": {
                                          "kind": {
                                            "StaticPropertyAccess": {
                                              "class": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "self"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 1666,
                                                      "end": 1670
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1666,
                                                  "end": 1670
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "Identifier": "excludedPaths"
                                                },
                                                "span": {
                                                  "start": 1672,
                                                  "end": 1686
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1666,
                                            "end": 1686
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1663,
                                        "end": 1686
                                      }
                                    },
                                    {
                                      "key": null,
                                      "kind": {
                                        "Spread": {
                                          "kind": {
                                            "Variable": "paths"
                                          },
                                          "span": {
                                            "start": 1691,
                                            "end": 1697
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1688,
                                        "end": 1697
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 1662,
                                  "end": 1698
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1639,
                            "end": 1698
                          }
                        }
                      },
                      "span": {
                        "start": 1639,
                        "end": 1699
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1570,
                "end": 1705
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 246,
        "end": 1707
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "RateLimitMiddleware",
            "span": {
              "start": 1715,
              "end": 1734
            }
          },
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
                "end": 1765
              }
            }
          ],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "MAX_REQUESTS",
                    "span": {
                      "start": 1786,
                      "end": 1798
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "value": {
                    "kind": {
                      "Int": 100
                    },
                    "span": {
                      "start": 1801,
                      "end": 1804
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 1772,
                "end": 1805
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "WINDOW_SECONDS",
                    "span": {
                      "start": 1824,
                      "end": 1838
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "value": {
                    "kind": {
                      "Int": 60
                    },
                    "span": {
                      "start": 1841,
                      "end": 1843
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 1810,
                "end": 1844
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "handle",
                    "span": {
                      "start": 1866,
                      "end": 1872
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "request",
                        "span": {
                          "start": 1881,
                          "end": 1889
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Request"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1873,
                              "end": 1880
                            }
                          }
                        },
                        "span": {
                          "start": 1873,
                          "end": 1880
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 1873,
                        "end": 1889
                      }
                    },
                    {
                      "name": {
                        "name": "next",
                        "span": {
                          "start": 1900,
                          "end": 1905
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1891,
                              "end": 1899
                            }
                          }
                        },
                        "span": {
                          "start": 1891,
                          "end": 1899
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 1891,
                        "end": 1905
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
                          "end": 1916
                        }
                      }
                    },
                    "span": {
                      "start": 1908,
                      "end": 1916
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
                                  "end": 1934
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
                                        "end": 1945
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "getIp"
                                      },
                                      "span": {
                                        "start": 1947,
                                        "end": 1952
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 1937,
                                  "end": 1954
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1931,
                            "end": 1954
                          }
                        }
                      },
                      "span": {
                        "start": 1931,
                        "end": 1955
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
                                  "end": 1968
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
                                        "end": 1978
                                      }
                                    },
                                    "op": "Concat",
                                    "right": {
                                      "kind": {
                                        "Variable": "ip"
                                      },
                                      "span": {
                                        "start": 1981,
                                        "end": 1984
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1971,
                                  "end": 1984
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1964,
                            "end": 1984
                          }
                        }
                      },
                      "span": {
                        "start": 1964,
                        "end": 1985
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
                                  "end": 2000
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
                                        "end": 2008
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "getCount"
                                      },
                                      "span": {
                                        "start": 2010,
                                        "end": 2018
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "key"
                                            },
                                            "span": {
                                              "start": 2019,
                                              "end": 2023
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 2019,
                                          "end": 2023
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 2003,
                                  "end": 2024
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 1994,
                            "end": 2024
                          }
                        }
                      },
                      "span": {
                        "start": 1994,
                        "end": 2025
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
                                  "end": 2045
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
                                              "Name": {
                                                "parts": [
                                                  "self"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 2048,
                                                  "end": 2052
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 2048,
                                              "end": 2052
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "MAX_REQUESTS"
                                            },
                                            "span": {
                                              "start": 2054,
                                              "end": 2066
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 2048,
                                        "end": 2066
                                      }
                                    },
                                    "op": "Sub",
                                    "right": {
                                      "kind": {
                                        "Variable": "count"
                                      },
                                      "span": {
                                        "start": 2069,
                                        "end": 2075
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2048,
                                  "end": 2075
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 2035,
                            "end": 2075
                          }
                        }
                      },
                      "span": {
                        "start": 2035,
                        "end": 2076
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
                                  "end": 2093
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
                                        "end": 2106
                                      }
                                    },
                                    "op": "Greater",
                                    "right": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 2109,
                                        "end": 2110
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2096,
                                  "end": 2110
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 2085,
                            "end": 2110
                          }
                        }
                      },
                      "span": {
                        "start": 2085,
                        "end": 2111
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
                                  "end": 2139
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
                                              "end": 2164
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 2155,
                                        "end": 2164
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "New": {
                                        "class": {
                                          "kind": {
                                            "Name": {
                                              "parts": [
                                                "Response"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 2172,
                                                "end": 2180
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 2172,
                                            "end": 2180
                                          }
                                        },
                                        "args": [
                                          {
                                            "name": null,
                                            "kind": {
                                              "Value": {
                                                "kind": {
                                                  "Int": 429
                                                },
                                                "span": {
                                                  "start": 2181,
                                                  "end": 2184
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 2181,
                                              "end": 2184
                                            }
                                          },
                                          {
                                            "name": null,
                                            "kind": {
                                              "Value": {
                                                "kind": {
                                                  "Array": [
                                                    {
                                                      "key": {
                                                        "kind": {
                                                          "String": "error"
                                                        },
                                                        "span": {
                                                          "start": 2187,
                                                          "end": 2194
                                                        }
                                                      },
                                                      "kind": {
                                                        "Value": {
                                                          "kind": {
                                                            "String": "Too many requests"
                                                          },
                                                          "span": {
                                                            "start": 2198,
                                                            "end": 2217
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 2187,
                                                        "end": 2217
                                                      }
                                                    }
                                                  ]
                                                },
                                                "span": {
                                                  "start": 2186,
                                                  "end": 2218
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 2186,
                                              "end": 2218
                                            }
                                          }
                                        ]
                                      }
                                    },
                                    "span": {
                                      "start": 2168,
                                      "end": 2219
                                    }
                                  },
                                  "span": {
                                    "start": 2155,
                                    "end": 2219
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
                                            "end": 2249
                                          }
                                        },
                                        "args": [
                                          {
                                            "name": null,
                                            "kind": {
                                              "Value": {
                                                "kind": {
                                                  "Variable": "request"
                                                },
                                                "span": {
                                                  "start": 2250,
                                                  "end": 2258
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 2250,
                                              "end": 2258
                                            }
                                          }
                                        ]
                                      }
                                    },
                                    "span": {
                                      "start": 2244,
                                      "end": 2259
                                    }
                                  },
                                  "span": {
                                    "start": 2233,
                                    "end": 2259
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 2128,
                            "end": 2270
                          }
                        }
                      },
                      "span": {
                        "start": 2121,
                        "end": 2271
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1850,
                "end": 2277
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "getCount",
                    "span": {
                      "start": 2300,
                      "end": 2308
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "key",
                        "span": {
                          "start": 2316,
                          "end": 2320
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 2309,
                              "end": 2315
                            }
                          }
                        },
                        "span": {
                          "start": 2309,
                          "end": 2315
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 2309,
                        "end": 2320
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
                          "end": 2326
                        }
                      }
                    },
                    "span": {
                      "start": 2323,
                      "end": 2326
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": {
                              "name": "counts",
                              "span": {
                                "start": 2348,
                                "end": 2355
                              }
                            },
                            "default": {
                              "kind": {
                                "Array": []
                              },
                              "span": {
                                "start": 2358,
                                "end": 2360
                              }
                            },
                            "span": {
                              "start": 2348,
                              "end": 2360
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 2341,
                        "end": 2361
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
                                        "end": 2377
                                      }
                                    },
                                    "index": {
                                      "kind": {
                                        "Variable": "key"
                                      },
                                      "span": {
                                        "start": 2378,
                                        "end": 2382
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2370,
                                  "end": 2383
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
                                                    "end": 2399
                                                  }
                                                },
                                                "index": {
                                                  "kind": {
                                                    "Variable": "key"
                                                  },
                                                  "span": {
                                                    "start": 2400,
                                                    "end": 2404
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 2392,
                                              "end": 2405
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 2386,
                                        "end": 2406
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
                                                    "end": 2416
                                                  }
                                                },
                                                "index": {
                                                  "kind": {
                                                    "Variable": "key"
                                                  },
                                                  "span": {
                                                    "start": 2417,
                                                    "end": 2421
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 2409,
                                              "end": 2422
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 2425,
                                              "end": 2426
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 2409,
                                        "end": 2426
                                      }
                                    },
                                    "else_expr": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 2429,
                                        "end": 2430
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 2386,
                                  "end": 2430
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 2370,
                            "end": 2430
                          }
                        }
                      },
                      "span": {
                        "start": 2370,
                        "end": 2431
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
                                  "end": 2454
                                }
                              },
                              "index": {
                                "kind": {
                                  "Variable": "key"
                                },
                                "span": {
                                  "start": 2455,
                                  "end": 2459
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 2447,
                            "end": 2460
                          }
                        }
                      },
                      "span": {
                        "start": 2440,
                        "end": 2461
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 2283,
                "end": 2467
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1709,
        "end": 2469
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 2469
  }
}
