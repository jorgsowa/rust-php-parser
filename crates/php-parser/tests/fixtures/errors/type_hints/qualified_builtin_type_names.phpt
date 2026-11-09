===source===
<?php
function a(\int $a, namespace\string $b): \void {}
function b(Foo\int $a, ?\array $b): \callable {}
function c(\Foo\Bar|\Integer $a): \iterable|\Traversable {}
===errors <=7.4===
Type declaration 'int' must be unqualified
Type declaration 'string' must be unqualified
Type declaration 'void' must be unqualified
Cannot use "Foo\int" as a type name as it is reserved
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
Type declaration 'iterable' must be unqualified
===errors 8.0-8.4===
Type declaration 'int' must be unqualified
Type declaration 'string' must be unqualified
Type declaration 'void' must be unqualified
Cannot use "Foo\int" as a type name as it is reserved
Type declaration 'iterable' must be unqualified
===errors >=8.5===
Type declaration 'int' must be unqualified
Type declaration 'string' must be unqualified
Type declaration 'void' must be unqualified
Cannot use "Foo\int" as a type name as it is reserved
Cannot use "array" as a type name as it is reserved
Cannot use "callable" as a type name as it is reserved
Type declaration 'iterable' must be unqualified
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'array' (T_ARRAY), expecting identifier (T_STRING) in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Type declaration 'void' must be unqualified in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 22,
                  "end": 24
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 17,
                      "end": 21
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 21
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 24
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 43,
                  "end": 45
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 26,
                      "end": 42
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 42
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 26,
                "end": 45
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
                "kind": "FullyQualified",
                "span": {
                  "start": 48,
                  "end": 53
                }
              }
            },
            "span": {
              "start": 48,
              "end": 53
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 66,
              "end": 67
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 76,
                  "end": 78
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Foo",
                      "int"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 68,
                      "end": 75
                    }
                  }
                },
                "span": {
                  "start": 68,
                  "end": 75
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 68,
                "end": 78
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 88,
                  "end": 90
                }
              },
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 81,
                          "end": 87
                        }
                      }
                    },
                    "span": {
                      "start": 81,
                      "end": 87
                    }
                  }
                },
                "span": {
                  "start": 80,
                  "end": 87
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 80,
                "end": 90
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "callable"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 93,
                  "end": 102
                }
              }
            },
            "span": {
              "start": 93,
              "end": 102
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 57,
        "end": 105
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 115,
              "end": 116
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 135,
                  "end": 137
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Foo",
                            "Bar"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 117,
                            "end": 125
                          }
                        }
                      },
                      "span": {
                        "start": 117,
                        "end": 125
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Integer"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 126,
                            "end": 134
                          }
                        }
                      },
                      "span": {
                        "start": 126,
                        "end": 134
                      }
                    }
                  ]
                },
                "span": {
                  "start": 117,
                  "end": 134
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 117,
                "end": 137
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "iterable"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 140,
                        "end": 149
                      }
                    }
                  },
                  "span": {
                    "start": 140,
                    "end": 149
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Traversable"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 150,
                        "end": 162
                      }
                    }
                  },
                  "span": {
                    "start": 150,
                    "end": 162
                  }
                }
              ]
            },
            "span": {
              "start": 140,
              "end": 162
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 106,
        "end": 165
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 165
  }
}
