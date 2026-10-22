===source===
<?php
class A {
    final const X = 1;
    final protected const Y = 1;
}
interface I {
    final public const X = 1;
}
===errors <=8.0===
'final class constants' requires PHP 8.1 or higher
'final class constants' requires PHP 8.1 or higher
'final class constants' requires PHP 8.1 or higher
===php_error <=8.0===
PHP Fatal error:  Cannot use 'final' as constant modifier in Standard input code on line 3
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 38
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 65,
                      "end": 66
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 69,
                      "end": 70
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 71
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 73
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 84,
              "end": 85
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 111,
                      "end": 112
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 115,
                      "end": 116
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 92,
                "end": 117
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 74,
        "end": 119
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 119
  }
}
