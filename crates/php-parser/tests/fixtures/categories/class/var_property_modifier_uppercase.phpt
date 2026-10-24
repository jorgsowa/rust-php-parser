===source===
<?php
class A {
    VAR $a;
    Var $b = 1, $c;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
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
                    "name": "a",
                    "span": {
                      "start": 24,
                      "end": 26
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_var": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 26
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_var": true
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 41,
                      "end": 42
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 32,
                "end": 42
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 44,
                      "end": 46
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_var": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 46
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
