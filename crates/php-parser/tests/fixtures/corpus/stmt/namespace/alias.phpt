===source===
<?php

use A\B;
use C\D as E;
use F\G as H, J;

// evil alias notation - Do Not Use!
use \A;
use \A as B;

// function and constant aliases
use function foo\bar;
use function foo\bar as baz;
use const foo\BAR;
use const foo\BAR as BAZ;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 11,
                  "end": 14
                }
              },
              "alias": null,
              "span": {
                "start": 11,
                "end": 14
              }
            }
          ]
        }
      },
      "span": {
        "start": 7,
        "end": 15
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
                  "C",
                  "D"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 20,
                  "end": 23
                }
              },
              "alias": "E",
              "span": {
                "start": 20,
                "end": 28
              }
            }
          ]
        }
      },
      "span": {
        "start": 16,
        "end": 29
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
                  "F",
                  "G"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 34,
                  "end": 37
                }
              },
              "alias": "H",
              "span": {
                "start": 34,
                "end": 42
              }
            },
            {
              "name": {
                "parts": [
                  "J"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 44,
                  "end": 45
                }
              },
              "alias": null,
              "span": {
                "start": 44,
                "end": 45
              }
            }
          ]
        }
      },
      "span": {
        "start": 30,
        "end": 46
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
                  "A"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 89,
                  "end": 91
                }
              },
              "alias": null,
              "span": {
                "start": 89,
                "end": 91
              }
            }
          ]
        }
      },
      "span": {
        "start": 85,
        "end": 92
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
                  "A"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 97,
                  "end": 99
                }
              },
              "alias": "B",
              "span": {
                "start": 97,
                "end": 104
              }
            }
          ]
        }
      },
      "span": {
        "start": 93,
        "end": 105
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "foo",
                  "bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 153,
                  "end": 160
                }
              },
              "alias": null,
              "span": {
                "start": 153,
                "end": 160
              }
            }
          ]
        }
      },
      "span": {
        "start": 140,
        "end": 161
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "foo",
                  "bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 175,
                  "end": 182
                }
              },
              "alias": "baz",
              "span": {
                "start": 175,
                "end": 189
              }
            }
          ]
        }
      },
      "span": {
        "start": 162,
        "end": 190
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Const",
          "uses": [
            {
              "name": {
                "parts": [
                  "foo",
                  "BAR"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 201,
                  "end": 208
                }
              },
              "alias": null,
              "span": {
                "start": 201,
                "end": 208
              }
            }
          ]
        }
      },
      "span": {
        "start": 191,
        "end": 209
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Const",
          "uses": [
            {
              "name": {
                "parts": [
                  "foo",
                  "BAR"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 220,
                  "end": 227
                }
              },
              "alias": "BAZ",
              "span": {
                "start": 220,
                "end": 234
              }
            }
          ]
        }
      },
      "span": {
        "start": 210,
        "end": 235
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 235
  }
}
===php_error===
PHP Warning:  The use statement with non-compound name 'J' has no effect in Standard input code on line 5
PHP Warning:  The use statement with non-compound name 'A' has no effect in Standard input code on line 8
PHP Fatal error:  Cannot use A as B because the name is already in use in Standard input code on line 9
Stack trace:
#0 {main}
