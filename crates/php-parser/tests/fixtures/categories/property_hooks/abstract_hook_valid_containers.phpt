===source===
<?php
abstract class C { abstract public $p { get; } }
trait T { abstract public $p { get; } }
interface I { public $p { get; } }
===php_error <=8.1===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error 8.2===
Cannot load Xdebug - it was already loaded
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error 8.3===
PHP Fatal error:  Cannot use the abstract modifier on a property in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                    "name": "p",
                    "span": {
                      "start": 41,
                      "end": 43
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 50
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 25,
                "end": 52
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 54
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 61,
              "end": 62
            }
          },
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 81,
                      "end": 83
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 86,
                        "end": 90
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 65,
                "end": 92
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 55,
        "end": 94
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 105,
              "end": 106
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 116,
                      "end": 118
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 121,
                        "end": 125
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 109,
                "end": 127
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 95,
        "end": 129
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 129
  }
}
