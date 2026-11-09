===source===
<?php
class C {
    const A = 1;
    const B = 2, A = 3;
}
===errors===
Cannot redefine class constant C::A
===php_error===
PHP Fatal error:  Cannot redefine class constant C::A in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 43,
                      "end": 44
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 47,
                      "end": 48
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 37,
                "end": 48
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 50,
                      "end": 51
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 54,
                      "end": 55
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 50,
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
