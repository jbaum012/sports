import { DateTime } from 'luxon'
/**
 * Groups the array {x} into arrays using the property {f}
 * https://stackoverflow.com/a/64489535/1396984
 */
export const groupBy = (x, f) => x.reduce((a, b) => ((a[f(b)] ||= []).push(b), a), {});

export function localize(dateTime) {
  const converted = DateTime.fromISO(dateTime, { zone: 'UTC' })
  return converted.toLocal()
}

export function localizedParts(dateTime) {
  localized = localize(dateTime)
  return {
    gameDay: localized.toFormat('cccc LLL d'),
    gameTime: localized.toFormat('t')
  }
}

export const gameDay = (dateTime) => {
  return localize(dateTime).toFormat('ccc LLL d');
}
export const gameTime = (dateTime) => {
  return localize(dateTime).toFormat('t');
}

export function localizeForInput(dateTime) {
  if (dateTime == null) {
    return null
  }

  const localized = localize(dateTime);
  return localized.toISO().substring(0, 16)
}
