===source===
<?php
namespace N;
class A {
    public function __construct(public $e { #[\NoDiscard] get => 1; }) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
expected ')', found end of file
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
===errors >=8.5===
#[\NoDiscard] is not supported for property hooks
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 4
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 4
===php_error >=8.5===
PHP Fatal error:  #[\NoDiscard] is not supported for property hooks in Standard input code on line 4
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
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 25,
              "end": 26
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 49,
                      "end": 60
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "e",
                        "span": {
                          "start": 68,
                          "end": 70
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "empty_hook_list": true,
                      "span": {
                        "start": 61,
                        "end": 70
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 104
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 104
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104
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
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 25,
              "end": 26
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 49,
                      "end": 60
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "e",
                        "span": {
                          "start": 68,
                          "end": 70
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 94,
                                "end": 95
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [
                            {
                              "name": {
                                "parts": [
                                  "NoDiscard"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 75,
                                  "end": 85
                                }
                              },
                              "args": [],
                              "span": {
                                "start": 75,
                                "end": 85
                              }
                            }
                          ],
                          "span": {
                            "start": 73,
                            "end": 96
                          }
                        }
                      ],
                      "span": {
                        "start": 61,
                        "end": 98
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 102
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 104
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104
  }
}
