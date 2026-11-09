===source===
<?php
namespace N;
use NoDiscard as Keep;
class A {
    public int $c { #[Keep] set { } }
}
===errors <=7.4===
'property hooks' requires PHP 8.4 or higher
Property hook list must not be empty
missing closing '}'
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
===errors >=8.5===
#[\NoDiscard] is not supported for property hooks
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 5
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 5
===php_error >=8.5===
PHP Fatal error:  #[\NoDiscard] is not supported for property hooks in Standard input code on line 5
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
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
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 23,
                  "end": 32
                }
              },
              "alias": {
                "name": "Keep",
                "span": {
                  "start": 36,
                  "end": 40
                }
              },
              "span": {
                "start": 23,
                "end": 40
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 41
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 48,
              "end": 49
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 67,
                      "end": 69
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 63,
                          "end": 66
                        }
                      }
                    },
                    "span": {
                      "start": 63,
                      "end": 66
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "empty_hook_list": true
                }
              },
              "span": {
                "start": 56,
                "end": 91
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 42,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
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
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 23,
                  "end": 32
                }
              },
              "alias": {
                "name": "Keep",
                "span": {
                  "start": 36,
                  "end": 40
                }
              },
              "span": {
                "start": 23,
                "end": 40
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 41
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 48,
              "end": 49
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 67,
                      "end": 69
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 63,
                          "end": 66
                        }
                      }
                    },
                    "span": {
                      "start": 63,
                      "end": 66
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "Keep"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 74,
                              "end": 78
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 74,
                            "end": 78
                          }
                        }
                      ],
                      "span": {
                        "start": 72,
                        "end": 87
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 56,
                "end": 89
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 42,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}
