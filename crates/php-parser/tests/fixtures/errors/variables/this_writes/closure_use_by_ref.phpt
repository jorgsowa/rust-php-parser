===source===
<?php
function () use ($a, &$this) {};
===errors===
Cannot use $this as lexical variable
===php_error===
PHP Fatal error:  Cannot use $this as lexical variable in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "use_vars": [
                {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 23,
                      "end": 25
                    }
                  },
                  "by_ref": false,
                  "span": {
                    "start": 23,
                    "end": 25
                  }
                },
                {
                  "name": {
                    "name": "this",
                    "span": {
                      "start": 28,
                      "end": 33
                    }
                  },
                  "by_ref": true,
                  "span": {
                    "start": 27,
                    "end": 33
                  }
                }
              ],
              "return_type": null,
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 37
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
