===source===
<?php
try {} catch (E $this) {}
===errors===
Cannot re-assign $this
===php_error===
PHP Fatal error:  Cannot re-assign $this in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "E"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 20,
                    "end": 21
                  }
                }
              ],
              "var": {
                "name": "this",
                "span": {
                  "start": 22,
                  "end": 27
                }
              },
              "body": [],
              "span": {
                "start": 13,
                "end": 31
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
