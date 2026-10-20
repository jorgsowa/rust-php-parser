===source===
<?php class Foo { public string $name = 'default' { get => $this->name; } }
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "=>" in Standard input code on line 1
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                      "start": 32,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 25,
                          "end": 31
                        }
                      }
                    },
                    "span": {
                      "start": 25,
                      "end": 31
                    }
                  },
                  "default": {
                    "kind": {
                      "String": "default"
                    },
                    "span": {
                      "start": 40,
                      "end": 49
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 59,
                                  "end": 64
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "name"
                                },
                                "span": {
                                  "start": 66,
                                  "end": 70
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 59,
                            "end": 70
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 52,
                        "end": 71
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 18,
                "end": 73
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 75
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 75
  }
}
