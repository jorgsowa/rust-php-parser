===config===
min_php=8.5
===source===
<?php
class A {
    #[DelayedTargetValidation] #[NoDiscard] public function __construct() {}
}
===errors===
Method A::__construct cannot be #[\NoDiscard]
===php_error===
PHP Fatal error:  Method A::__construct cannot be #[\NoDiscard] in Standard input code on line 3
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 76,
                      "end": 87
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "DelayedTargetValidation"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 45
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 45
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 49,
                          "end": 58
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 49,
                        "end": 58
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 92
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
