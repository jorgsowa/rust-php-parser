===source===
<?php
interface I {
    static function __construct(): void;
    static function __destruct(): void;
    static function __clone(): void;
}
===errors >=8.0===
Method I::__construct() cannot be static
Method I::__construct() cannot declare a return type
Method I::__destruct() cannot be static
Method I::__destruct() cannot declare a return type
Method I::__clone() cannot be static
===php_error >=8.0===
PHP Fatal error:  Method I::__construct() cannot be static in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 40,
                      "end": 51
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 55,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 55,
                      "end": 59
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 60
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__destruct",
                    "span": {
                      "start": 81,
                      "end": 91
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 95,
                          "end": 99
                        }
                      }
                    },
                    "span": {
                      "start": 95,
                      "end": 99
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 65,
                "end": 100
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__clone",
                    "span": {
                      "start": 121,
                      "end": 128
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 132,
                          "end": 136
                        }
                      }
                    },
                    "span": {
                      "start": 132,
                      "end": 136
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 105,
                "end": 137
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 139
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 139
  }
}
