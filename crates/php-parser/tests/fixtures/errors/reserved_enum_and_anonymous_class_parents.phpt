===source===
<?php
enum E implements self {}
enum F implements I, \parent {}
new class extends self {};
new class extends \static {};
new class implements I, parent {};
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Cannot use "self" as interface name, as it is reserved
'enums' requires PHP 8.1 or higher
'\parent' is an invalid class name
Cannot use "self" as class name, as it is reserved
'\static' is an invalid class name
Cannot use "parent" as interface name, as it is reserved
===errors >=8.1===
Cannot use "self" as interface name, as it is reserved
'\parent' is an invalid class name
Cannot use "self" as class name, as it is reserved
'\static' is an invalid class name
Cannot use "parent" as interface name, as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot use "self" as interface name, as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [
            {
              "parts": [
                "self"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 24,
                "end": 28
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "F",
            "span": {
              "start": 37,
              "end": 38
            }
          },
          "scalar_type": null,
          "implements": [
            {
              "parts": [
                "I"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 50,
                "end": 51
              }
            },
            {
              "parts": [
                "parent"
              ],
              "kind": "FullyQualified",
              "span": {
                "start": 53,
                "end": 60
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 32,
        "end": 63
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
                    "name": null,
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "self"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 82,
                        "end": 86
                      }
                    },
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 64,
                  "end": 89
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 64,
            "end": 89
          }
        }
      },
      "span": {
        "start": 64,
        "end": 90
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
                    "name": null,
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "static"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 109,
                        "end": 116
                      }
                    },
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 91,
                  "end": 119
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 91,
            "end": 119
          }
        }
      },
      "span": {
        "start": 91,
        "end": 120
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
                    "name": null,
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": null,
                    "implements": [
                      {
                        "parts": [
                          "I"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 142,
                          "end": 143
                        }
                      },
                      {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 145,
                          "end": 151
                        }
                      }
                    ],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 121,
                  "end": 154
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 121,
            "end": 154
          }
        }
      },
      "span": {
        "start": 121,
        "end": 155
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 155
  }
}
