===source===
<?php
class User {
    public protected(set) string $name;
    public private(set) int $age;
    protected private(set) string $email = '';
}
===errors <=8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
===php_error <=8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "User",
            "span": {
              "start": 12,
              "end": 16
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
                    "name": "name",
                    "span": {
                      "start": 52,
                      "end": 57
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Protected"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 45,
                          "end": 51
                        }
                      }
                    },
                    "span": {
                      "start": 45,
                      "end": 51
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 57
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "age",
                    "span": {
                      "start": 87,
                      "end": 91
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 83,
                          "end": 86
                        }
                      }
                    },
                    "span": {
                      "start": 83,
                      "end": 86
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 63,
                "end": 91
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "email",
                    "span": {
                      "start": 127,
                      "end": 133
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "set_visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 120,
                          "end": 126
                        }
                      }
                    },
                    "span": {
                      "start": 120,
                      "end": 126
                    }
                  },
                  "default": {
                    "kind": {
                      "String": ""
                    },
                    "span": {
                      "start": 136,
                      "end": 138
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 97,
                "end": 138
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 141
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 141
  }
}
