===source===
<?php
function test(
    bool $a1, int $a2, float $a3, string $a4, // PHP 7.0
    iterable $a5, // PHP 7.1
    object $a6, // PHP 7.2
    mixed $a7, // PHP 8.0
    null $a8, // PHP 8.0
    false $a9, // PHP 8.0
): void {} // PHP 7.1
function test2(): never {} // PHP 8.1
===errors <=7.4===
'mixed type' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
'null as standalone type' requires PHP 8.2 or higher
'false type' requires PHP 8.0 or higher
'false as standalone type' requires PHP 8.2 or higher
===errors 8.0-8.1===
'null as standalone type' requires PHP 8.2 or higher
'false as standalone type' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting variable (T_VARIABLE) in Standard input code on line 9
===php_error 8.0-8.1===
PHP Fatal error:  Null can not be used as a standalone type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "params": [
            {
              "name": {
                "name": "a1",
                "span": {
                  "start": 30,
                  "end": 33
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "bool"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 25,
                      "end": 29
                    }
                  }
                },
                "span": {
                  "start": 25,
                  "end": 29
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 25,
                "end": 33
              }
            },
            {
              "name": {
                "name": "a2",
                "span": {
                  "start": 39,
                  "end": 42
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
                      "start": 35,
                      "end": 38
                    }
                  }
                },
                "span": {
                  "start": 35,
                  "end": 38
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 35,
                "end": 42
              }
            },
            {
              "name": {
                "name": "a3",
                "span": {
                  "start": 50,
                  "end": 53
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "float"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 44,
                      "end": 49
                    }
                  }
                },
                "span": {
                  "start": 44,
                  "end": 49
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 44,
                "end": 53
              }
            },
            {
              "name": {
                "name": "a4",
                "span": {
                  "start": 62,
                  "end": 65
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
                      "start": 55,
                      "end": 61
                    }
                  }
                },
                "span": {
                  "start": 55,
                  "end": 61
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 55,
                "end": 65
              }
            },
            {
              "name": {
                "name": "a5",
                "span": {
                  "start": 91,
                  "end": 94
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "iterable"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 82,
                      "end": 90
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 90
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 82,
                "end": 94
              }
            },
            {
              "name": {
                "name": "a6",
                "span": {
                  "start": 118,
                  "end": 121
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "object"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 111,
                      "end": 117
                    }
                  }
                },
                "span": {
                  "start": 111,
                  "end": 117
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 111,
                "end": 121
              }
            },
            {
              "name": {
                "name": "a7",
                "span": {
                  "start": 144,
                  "end": 147
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "mixed"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 138,
                      "end": 143
                    }
                  }
                },
                "span": {
                  "start": 138,
                  "end": 143
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 138,
                "end": 147
              }
            },
            {
              "name": {
                "name": "a8",
                "span": {
                  "start": 169,
                  "end": 172
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "null"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 164,
                      "end": 168
                    }
                  }
                },
                "span": {
                  "start": 164,
                  "end": 168
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 164,
                "end": 172
              }
            },
            {
              "name": {
                "name": "a9",
                "span": {
                  "start": 195,
                  "end": 198
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "false"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 189,
                      "end": 194
                    }
                  }
                },
                "span": {
                  "start": 189,
                  "end": 194
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 189,
                "end": 198
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 214,
                  "end": 218
                }
              }
            },
            "span": {
              "start": 214,
              "end": 218
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 221
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test2",
            "span": {
              "start": 242,
              "end": 247
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 251,
                  "end": 256
                }
              }
            },
            "span": {
              "start": 251,
              "end": 256
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 233,
        "end": 259
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 259
  }
}
