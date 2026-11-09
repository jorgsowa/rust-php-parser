===source===
<?php
class K {
    public function h(): (self&B)|K {}
}
===errors <=7.4===
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'DNF types' requires PHP 8.2 or higher
Type self cannot be part of an intersection type
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
Type self cannot be part of an intersection type
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
Type self cannot be part of an intersection type
===errors 8.2-8.4===
Type self cannot be part of an intersection type
===errors >=8.5===
Type K&B is redundant as it is more restrictive than type K
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 3
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 3
===php_error 8.2-8.4===
PHP Fatal error:  Type self cannot be part of an intersection type in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Type K&B is redundant as it is more restrictive than type K in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "K",
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
                "Method": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "self"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 42,
                                      "end": 46
                                    }
                                  }
                                },
                                "span": {
                                  "start": 42,
                                  "end": 46
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "B"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 47,
                                      "end": 48
                                    }
                                  }
                                },
                                "span": {
                                  "start": 47,
                                  "end": 48
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 41,
                            "end": 49
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "K"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 50,
                                "end": 51
                              }
                            }
                          },
                          "span": {
                            "start": 50,
                            "end": 51
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 41,
                      "end": 51
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 54
              }
            }
          ],
          "attributes": []
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
