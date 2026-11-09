===source===
<?php
$o = new class {
    final private const X = 1;
};
===errors <=8.0===
'final class constants' requires PHP 8.1 or higher
Private constant class@anonymous::X cannot be final as it is not visible to other classes
===errors >=8.1===
Private constant class@anonymous::X cannot be final as it is not visible to other classes
===php_error <=8.0===
PHP Fatal error:  Cannot use 'final' as constant modifier in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Private constant class@anonymous::X cannot be final as it is not visible to other classes in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
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
                          "implements": [],
                          "members": [
                            {
                              "kind": {
                                "ClassConst": {
                                  "name": {
                                    "name": "X",
                                    "span": {
                                      "start": 47,
                                      "end": 48
                                    }
                                  },
                                  "modifiers": {
                                    "visibility": "Private",
                                    "is_final": true
                                  },
                                  "value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 51,
                                      "end": 52
                                    }
                                  },
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 27,
                                "end": 53
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 55
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 55
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 55
          }
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
